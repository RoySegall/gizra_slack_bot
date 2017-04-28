<?php

require 'vendor/autoload.php';

$resolver = new \Cron\Resolver\ArrayResolver();

// Get all the tasks.
foreach (\Nuntius\Nuntius::getCronTasksManager()->getCronTasks() as $cron_task) {
  $job = new \Cron\Job\ShellJob();
  $job->setCommand('/Applications/MAMP/bin/php/php7.0.13/bin/php ' . __DIR__ . '/console.php nuntius:cron ' . $cron_task->getName());
  $job->setSchedule(new \Cron\Schedule\CrontabSchedule($cron_task->getPeriod()));

  // Register the task.
  $resolver->addJob($job);
}

$cron = new \Cron\Cron();
$cron->setExecutor(new \Cron\Executor\Executor());
$cron->setResolver($resolver);

$cron->run();
