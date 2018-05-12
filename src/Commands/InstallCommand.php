<?php

namespace Nuntius\Commands;

use MongoDB\Client;
use Nuntius\Nuntius;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Yaml;

/**
 * CLI command to install the bot.
 */
class InstallCommand extends Command  {

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('nuntius:install')
      ->setDescription('Install nuntius')
      ->setHelp('Set up nuntius');
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $io = new SymfonyStyle($input, $output);

    if (!file_exists(__DIR__ . '/../../settings/credentials.local.yml')) {
      $question = new ConfirmationQuestion('The credentials yml file is missing. Would you like to generate the file?');

      if (!$io->askQuestion($question)) {
        $io->block('Well then, you need to create a copy of the file credentials.yml to credentials.local.yml and populate the values. Good luck!');
        return;
      }

      $settings = $this->generateCredentials($io);
      Nuntius::getDb()->setDriver($settings['db_driver']);
    }

    $value = Nuntius::getSettings()->getSettings();
    $operations = Nuntius::getDb()->getOperations();
    $storage = Nuntius::getDb()->getStorage();

    $io->section("Setting up the DB.");

    if ($operations->dbExists($value['rethinkdb']['db'])) {
      $io->success("The DB already exists, skipping.");
    }
    else {
      $operations->dbCreate($value['rethinkdb']['db']);
      $io->success("The DB was created");
      sleep(5);
    }

    $io->section("Creating entities tables.");

    foreach (array_keys($value['entities']) as $table) {
      if ($operations->tableExists($table)) {
        $io->success("The table {$table} already exists, skipping.");
      }
      else {
        $operations->tableCreate($table);
        $io->success("The table {$table} has created");
      }
    }

    // Run this again.
    $storage->table('system')->save(['id' => 'updates', 'processed' => array_keys(Nuntius::getUpdateManager()->getUpdates())]);

    $io->section("The install has completed.");
    $io->text('run php console.php nuntius:run');
  }

  /**
   * Generate the credentials file.
   *
   * @param SymfonyStyle $io
   *   The io object.
   *
   * @return mixed
   *   The settings.
   */
  protected function generateCredentials(SymfonyStyle $io) {
    $settings = [];

    $settings['access_token'] = $io->ask('Enter Slack access token');
    $settings['db_driver'] = $io->choice('Select DB driver', ['rethinkdb' => 'RethinkDB','mongodb' => 'MongoDB'], 'rethinkdb');
    $db_connection_ok = TRUE;

    $setting_method = 'setDb' . ucfirst($settings['db_driver']) . 'Settings';
    $connection_method = 'checkDb' . ucfirst($settings['db_driver']) . 'Settings';
    while ($db_connection_ok) {
      $this->{$setting_method}($settings, $io);

      if ($this->{$connection_method}($settings, $io)) {
        break;
      }
    }

    $yml_content = YAML::dump($settings);
    $io->block("This are the settings:\n" . $yml_content);

    if (!$io->confirm('Do you approve the settings?')) {
      $io->block("OK. Let's start again");
      $this->generateCredentials($io);
    }

    $fs = new Filesystem();
    $fs->dumpFile(__DIR__ . '/../../settings/credentials.local.yml', $yml_content);

    return $settings;
  }

  /**
   * Set the settings for RethinkDB.
   *
   * @param $settings
   *  The settings variable.
   */
  protected function setDbRethinkdbSettings(&$settings, SymfonyStyle $io) {
    $settings['rethinkdb']['host'] = $io->ask('Enter the address of the DB', 'localhost');
    $settings['rethinkdb']['port'] = $io->ask('Enter the port address of the DB', 28015);
    $settings['rethinkdb']['db'] = $io->ask('Enter the DB name', 'nuntius');
    $settings['rethinkdb']['api_key'] = $io->ask('Enter the API key', 'none');
    $settings['rethinkdb']['timeout'] = $io->ask('Enter the timeout for the DB connection', 30);

    if ($settings['rethinkdb']['api_key'] == 'none') {
      $settings['rethinkdb']['api_key'] = '';
    }
  }

  /**
   * Check the connection.
   *
   * @param $settings
   * @param SymfonyStyle $io
   */
  protected function checkDbRethinkdbSettings(&$settings, SymfonyStyle $io) {
    try {
      @\r\connect($settings['rethinkdb']['host'], $settings['rethinkdb']['port'], $settings['rethinkdb']['db'], $settings['rethinkdb']['api_key'], $settings['rethinkdb']['timeout']);
    } catch (\Exception $e) {
      $io->error("Hmm.. It seems there is an error: " . $e->getMessage() . ". Let's start again.");
      return FALSE;
    }

    return TRUE;
  }

  /**
   * Set the settings for MongoDB.
   *
   * @param $settings
   * @param SymfonyStyle $io
   */
  protected function setDbMongodbSettings(&$settings, SymfonyStyle $io) {
    $settings['mongodb']['uri'] = $io->ask('Enter the URI of the server', 'mongodb://127.0.0.1/');
    $settings['mongodb']['db'] = $io->ask('Enter the DB name', 'nuntius');

    if ($username = $io->ask('Enter the username', FALSE)) {
      $settings['mongodb']['username'] = $username;
    }

    if ($password = $io->ask('Enter the password', FALSE)) {
      $settings['mongodb']['password'] = $password;
    }
  }

  /**
   * Check the connection for MongoDB.
   *
   * @param $settings
   * @param SymfonyStyle $io
   */
  protected function checkDbMongodbSettings(&$settings, SymfonyStyle $io) {
    $options = [];

    if (!empty($settings['mongodb']['username']) && !empty($settings['mongodb']['password'])) {
      // Setting up username and password.
      $options['username'] = $settings['mongodb']['username'];
      $options['password'] = $settings['mongodb']['password'];
    }

    try {
      $collection = new Client($settings['mongodb']['uri'], $options);
      $collection->listDatabases();
    } catch (\Exception $e) {
      $io->error("Hmm.. It seems there is an error: " . $e->getMessage() . ". Let's start again.");
      return FALSE;
    }

    return TRUE;
  }

}
