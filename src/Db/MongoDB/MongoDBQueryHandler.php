<?php

namespace Nuntius\Db\MongoDB;

use Nuntius\Db\DbQueryHandlerInterface;

/**
 * MongoDB query handler.
 */
class MongoDBQueryHandler implements DbQueryHandlerInterface {

  /**
   * The table name.
   *
   * @var string
   */
  protected $table;

  /**
   * List of conditions.
   *
   * @var array
   */
  protected $conditions = [];

  /**
   * Holds information for the pager of the query.
   *
   * @var array
   */
  protected $range = [];

  /**
   * Keep the sort settings.
   *
   * @var array
   */
  protected $sort = [];

  /**
   * A flag which determine if the query need to in readl time or not.
   *
   * @var bool
   */
  protected $changes = FALSE;

  /**
   * @var array
   *
   * Keep the allowed operators on the query.
   */
  protected $operators = [
    '=' => 'eq',
    '!=' => 'ne',
    '>' => 'gt',
    '>=' => 'ge',
    '<' => 'lt',
    '<=' => 'le',
    'CONTAINS' => 'match',
    'IN' => 'args',
  ];

  /**
   * Constructing the query.
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
  public function condition($property, $value, $operator = '=') {
    $this->conditions[] = [
      'property' => $property,
      'value' => $value,
      'operator' => $operator,
    ];

    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function pager($start, $length) {
    $this->range = [
      'start' => $start,
      'length' => $length,
    ];

    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function orderBy($field, $direction) {
    $this->sort[] = [
      'field' => $field,
      'direction' => $direction,
    ];
    return $this;
  }

  /**
   * Set the mode of the changes flag.
   *
   * @param bool $mode
   *   The mode of the flag.
   *
   * @return MongoDBQueryHandler
   *   The current instance.
   */
  public function setChanges($mode = TRUE) {
    throw new \Exception('The DB does not support real time.');
  }

  /**
   * Return the changes flag.
   *
   * @return bool
   */
  public function getChanges() {
    throw new \Exception('The DB does not support real time.');
  }

  /**
   * {@inheritdoc}
   */
  public function execute() {
    $items = [];

    $this->cleanUp();

    return $items;
  }

  /**
   * {@inheritdoc}
   */
  public function cleanUp() {
    $this->table = '';
    $this->conditions = [];
    $this->sort = [];
    $this->range = [];
  }

}
