<?php

namespace Nuntius;

class CronManager {

  /**
   * List of cron tasks.
   *
   * @var CronTaskInterface[]
   */
  protected $cronTasks;

  /**
   * CronManager constructor.
   *
   * @param \Nuntius\NuntiusConfig $config
   */
  function __construct(NuntiusConfig $config) {
    $this->setCronTasks($config->getSetting('cron'));
  }

  /**
   * Set cron tasks.
   *
   * @param array $cron_tasks
   *   List of cron tasks.
   *
   * @return $this
   *   The current instance.
   */
  public function setCronTasks(array $cron_tasks) {

    foreach ($cron_tasks as $cron => $namespace) {
      $this->cronTasks[$cron] = new $namespace(Nuntius::container(), $cron);
    }

    return $this;
  }

}

