<?php

namespace Nuntius;

interface CronTaskInterface {

  /**
   * Running the command.
   */
  public function run();

  /**
   * Set the period.
   *
   * @param string $period
   *   The period of the operation.
   *
   * @return $this
   *   The current instance.
   */
  public function setPeriod($period);

  /**
   * Get the period.
   *
   * @return string
   *   The period of the cron task.
   */
  public function getPeriod();

}
