<?php

namespace Nuntius;

/**
 * Abstract class for entities.
 */
abstract class EntityBase implements EntityBaseInterface {

  /**
   * The RethinkDB connection.
   *
   * @var \Nuntius\NuntiusRethinkdb
   */
  protected $db;

  /**
   * The entity ID.
   *
   * @var string
   */
  protected $entityID;

  /**
   * The storage of the DB.
   *
   * @var Db\DbStorageHandlerInterface
   */
  protected $storage;

  /**
   * EntityBase constructor.
   *
   * @param \Nuntius\NuntiusRethinkdb $db
   *   The RethinkDB connection.
   * @param string $entity_id
   *   The entity ID.
   */
  function __construct(NuntiusRethinkdb $db, $entity_id) {
    $this->db = $db;
    $this->entityID = $entity_id;
    $this->storage = Nuntius::getDb()->getStorage();
  }

  /**
   * Return the current instance object with the values from the DB.
   *
   * @param array $data
   *   The data representation of the object.
   *
   * @return $this
   *   The current object.
   */
  protected function createInstance($data) {
    $this_copy = clone $this;

    foreach ($data as $property => $value) {
      $this_copy->{$property} = $value;
    }

    return $this_copy;
  }

  /**
   * Get the table handler.
   *
   * @return \r\Queries\Tables\Table
   */
  public function getTable() {
    return $this->db->getTable($this->entityID);
  }

  /**
   * {@inheritdoc}
   */
  public function loadMultiple(array $ids = []) {
    $results = [];

    foreach ($this->getTable()->getAll(\r\args($ids))->run($this->db->getConnection()) as $result) {
      $data = $result->getArrayCopy();
      $results[$data['id']] = $this->createInstance($data);
    }

    return $results;
  }

  /**
   * {@inheritdoc}
   */
  public function load($id) {
    if (!$data = $this->getTable()->get($id)->run($this->db->getConnection())) {
      return FALSE;
    }

    $data = $data->getArrayCopy();
    return $this->createInstance($data);
  }

  /**
   * {@inheritdoc}
   */
  public function insert(array $item) {

    if (!isset($item['time'])) {
      $item['time'] = time();
    }

    $result = $this->getTable()->insert($item)->run($this->db->getConnection())->getArrayCopy();

    return $this->load(reset($result['generated_keys']));
  }

  /**
   * {@inheritdoc}
   */
  public function delete($id) {
    $this->getTable()->get($id)->delete()->run($this->db->getConnection());
  }

  /**
   * {@inheritdoc}
   */
  public function update($id, $data) {
    $this->getTable()->get($id)->update($data)->run($this->db->getConnection());
  }

}
