<?php

require_once 'autoloader.php';

$time_start = microtime(true);

try {

//  \Nuntius\Nuntius::getCapsuleManager()->enableCapsule('system');

  /** @var \Nuntius\System\Plugin\Cache\Memcache $cache */
  $cache = \Nuntius\System\System::getCacheManager()->createInstance('memcache');

  /** @var \Nuntius\System\Plugin\Entity\System $entity */
  $entity = \Nuntius\System\System::getEntityManager()->createInstance('system');

//  $cache->set('a', $entity->loadMultiple());
//
  $cache->get('a');


//  if (!$cache_results = $cache->get('entities')) {
//    $cache_results = $cache->set('entities', $entity->loadMultiple());
//  } else {
//    $cache_results['data'] = $entity->loadMultiple();
//  }

//  $cache->clear();
} catch (Exception $e) {
  d($e->getMessage());
}

$time_end = microtime(true);

$execution_time = ($time_end - $time_start)/60;

echo "The time of execution is: {$execution_time}\n";