<?php

require_once 'vendor/autoload.php';

$crons = \Nuntius\Nuntius::getCronTasksManager();

foreach ($crons->getCronTasks() as $cron_task) {
  Kint::dump($cron_task->getPeriod());
}