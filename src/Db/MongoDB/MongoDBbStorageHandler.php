<?php

namespace Nuntius\Db\MongoDB;

use Nuntius\Db\DbStorageHandlerInterface;

/**
 * MongoDB storage handler.
 */
class MongoDBbStorageHandler implements DbStorageHandlerInterface {

  /**
   * The table name.
   *
   * @var string
   */
  protected $table;

  /**
   * The connection object.
   *
   * @var \r\Connection
   */
  protected $connection;

  /**
   * Constructing.
   */
  function __construct() {
  }

  /**
   * {@inheritdoc}
   */
  public function table($table) {
    $this->table = $table;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function save($document) {
    return $document;
  }

  /**
   * {@inheritdoc}
   */
  public function load($id) {
    $items = [];

    return reset($items);
  }

  /**
   * {@inheritdoc}
   */
  public function loadMultiple(array $ids = []) {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function update($document) {
    return $document;
  }

  /**
   * {@inheritdoc}
   */
  public function delete($id) {
    $this->deleteMultiple([$id]);
  }

  /**
   * {@inheritdoc}
   */
  public function deleteMultiple(array $ids = []) {
  }

}
