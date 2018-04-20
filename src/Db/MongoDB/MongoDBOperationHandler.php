<?php

namespace Nuntius\Db\MongoDB;

use MongoDB\Driver\Exception\ConnectionTimeoutException;
use Nuntius\Db\DbOperationHandlerInterface;
use Nuntius\Nuntius;

/**
 * MongoDB operation handler.
 */
class MongoDBOperationHandler implements DbOperationHandlerInterface {

  /**
   * The connection object.
   *
   * @var \r\Connection
   */
  protected $connection;

  /**
   * The DB name.
   *
   * @var string
   */
  protected $db;

  /**
   * @var \Nuntius\NuntiusMongoDB
   */
  protected $mongo;

  /**
   * @var \MongoDB\Client
   */
  protected $client;

  /**
   * Constructing.
   */
  function __construct() {
    $this->db = Nuntius::getSettings()->getSetting('mongodb')['db'];
    $this->mongo = Nuntius::getMongoDB()->getConnection();
    $this->client = Nuntius::getMongoDB()->getClient();

    try  {
      $this->mongo->listCollections();
      $this->connection = TRUE;
    } catch (ConnectionTimeoutException $e) {
      $this->connection = FALSE;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function connected() {
    return $this->connection;
  }

  /**
   * {@inheritdoc}
   */
  public function getError() {
  }

  /**
   * {@inheritdoc}
   */
  public function dbCreate($db) {
    // Create a collection in non existing db in order to create the DB.
    $this->client->{$db}->createCollection('_placeholder');
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function dbDrop($db) {
    // Dropping all the tables in order to drop the table.
    foreach ($this->client->{$db}->listCollections() as $collection) {
      $this->client->{$db}->dropCollection($collection->getName());
    }

    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function dbList() {
  }

  /**
   * {@inheritdoc}
   */
  public function dbExists($db) {
    return in_array($db, $this->dbList());
  }

  /**
   * {@inheritdoc}
   */
  public function tableCreate($table) {
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function tableDrop($table) {
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function tableList() {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function tableExists($table) {
    return in_array($table, $this->tableList());
  }

  /**
   * {@inheritdoc}
   */
  public function indexCreate($table, $column) {
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function indexDrop($table, $column) {
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function indexList($table) {
    return [];
  }

  /**
   * Making sure the index exists in a table.
   *
   * @param $table
   *   The table name.
   * @param $column
   *   The columns name.
   *
   * @return bool
   */
  public function indexExists($table, $column) {
    return in_array($column, $this->indexList($table));
  }

}
