<?php

require 'vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();

$commands = \Nuntius\Nuntius::getSettings()['commands'];

foreach ($commands as $namespace) {
  $application->add(new $namespace);
}

$application->run();