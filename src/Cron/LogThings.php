<?php

namespace Nuntius\Cron;

use Nuntius\CronTaskAbstract;
use Nuntius\CronTaskInterface;

class LogThings extends CronTaskAbstract implements CronTaskInterface {

  /**
   * {@inheritdoc}
   */
  protected $period = '*/5 * * * *';

  /**
   * {@inheritdoc}
   */
  public function run() {
  }


}