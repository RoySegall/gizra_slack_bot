<?php

namespace Nuntius;
use MongoDB\Client;

/**
 * MongoDB layer manager.
 */
class NuntiusMongoDB {

  /**
   * @var \MongoDB\Database
   */
  protected $connection;

  /**
   * The DB name.
   *
   * @var string
   */
  protected $db;

  /**
   * The DB connection error.
   *
   * @var string
   */
  public $error;

  /**
   * NuntiusRethinkdb constructor.
   *
   * @param NuntiusConfig $config
   *   The config service.
   */
  function __construct(NuntiusConfig $config) {
    $info = $config->getSetting('mongodb');

    $collection = new Client($info['uri']);

    $this->connection = $collection->{$info['db']};
  }

  /**
   * Getting the connect object.
   *
   * @return \MongoDB\Database
   */
  public function getConnection() {
    return $this->connection;
  }

}
