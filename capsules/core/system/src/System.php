<?php

namespace Nuntius\System;

use Nuntius\Nuntius;

class System {

  /**
   * Get the hooks dispatcher service.
   *
   * @return HooksDispatcher
   *  The hook dispatcher service.
   *
   * @throws \Exception
   */
  public static function hooksDispatcher() {
    return Nuntius::container()->get('hooks_dispatcher');
  }

  /**
   * Get the plugin manager.
   *
   * @return PluginManager
   *  The plugin manager instance.
   *
   * @throws \Exception
   */
  public static function getPluginManger() {
    return Nuntius::container()->get('plugin_manager');
  }

  /**
   * Get the entity manager instance.
   *
   * @return EntityPluginManager
   * 
   * @throws \Exception
   */
  public static function getEntityManager() {
    return Nuntius::container()->get('entity.plugin_manager');
  }

  /**
   * @return CachePluginManager
   *
   * @throws \Exception
   */
  public static function getCacheManager() {
      return Nuntius::container()->get('cache.plugin_manager');
  }

}
