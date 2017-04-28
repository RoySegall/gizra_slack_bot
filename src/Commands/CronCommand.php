<?php

namespace Nuntius\Commands;

use Nuntius\Nuntius;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CronCommand extends Command {

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('nuntius:cron')
      ->setDescription('Run cron')
      ->setHelp('Run a cron task')
      ->addArgument('cron_task', InputArgument::REQUIRED, 'The cron task');
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    Nuntius::getEntityManager()->get('logger')->insert(['a' => 'bar']);
    Nuntius::getCronTasksManager()->getCronTask($input->getArgument('cron_task'))->run();
  }

}
