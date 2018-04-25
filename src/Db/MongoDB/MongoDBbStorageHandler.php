<?php

namespace Nuntius\Db\MongoDB;

use Nuntius\Db\DbStorageHandlerInterface;
use Nuntius\Nuntius;

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
   * @var \MongoDB\Database
   */
  protected $mongo;

  /**
   * Constructing.
   */
  function __construct() {
    $this->mongo = Nuntius::getMongoDB()->getConnection();
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
    $result = $this->mongo->selectCollection($this->table)->insertOne($document);
    $id = $result->getInsertedId();
    $document['id'] = $id->__toString();
    return $document;
  }

  /**
   * {@inheritdoc}
   */
  public function load($id) {
    $items = $this->loadMultiple([$id]);

    return reset($items);
  }

  /**
   * {@inheritdoc}
   */
  public function loadMultiple(array $ids = []) {
    $this->
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
