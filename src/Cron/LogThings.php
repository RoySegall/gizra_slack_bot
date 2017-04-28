<?php

namespace Nuntius\Cron;

use Nuntius\CronTaskAbstract;
use Nuntius\CronTaskInterface;
use Nuntius\EntityManager;

class LogThings extends CronTaskAbstract implements CronTaskInterface {

  /**
   * {@inheritdoc}
   */
  protected $period = '*/5 * * * *';

  /**
   * {@inheritdoc}
   */
  public function run() {
    /** @var EntityManager $entity_manager */
    $entity_manager = $this->container->get('manager.entity');
    $entity_manager->get('logger')->insert(['time' => time()]);
  }

}
