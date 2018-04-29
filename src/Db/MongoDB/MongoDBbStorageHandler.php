<?php

namespace Nuntius\Db\MongoDB;

use MongoDB\Model\BSONDocument;
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

    if (!isset($document['time'])) {
      $document['time'] = time();
    }

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
    $query = $this->mongo->selectCollection($this->table);

    $filter = [];

    if ($ids) {
      $filter['_id'] = ['$in' => self::processIdsToFilter($ids)];
    }

    /** @var BSONDocument[] $cursor */
    $cursor = $query->find($filter);

    $results = [];

    foreach ($cursor as $doc) {
      // Get the item.
      $item = $doc->getArrayCopy();

      // Order the object.
      $item['id'] = $item['_id']->__toString();
      unset($item['_id']);

      // Add to list.
      $results[] = $item;
    }

    return $results;
  }

  /**
   * {@inheritdoc}
   */
  public function update($document) {
    $this->mongo->selectCollection($this->table)->updateOne(
      ['_id' => new \MongoDB\BSON\ObjectId($document['id'])],
      ['$set' => $document]
    );
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
    $this->mongo
      ->selectCollection($this->table)
      ->deleteMany(['_id' => [
        '$in' => $this->processIdsToFilter($ids)
        ]
      ]);
  }

  /**
   * Process a list of ids to a filterable list of ids.
   *
   * @param $ids
   *   The list of IDs.
   *
   * @return array
   *   Return a list of IDs which can be passed to the filter array.
   */
  public static function processIdsToFilter($ids) {
    return array_map(function($id) {
      return new \MongoDB\BSON\ObjectId($id);
    }, $ids);
  }

}
