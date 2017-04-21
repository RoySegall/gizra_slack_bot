<?php

namespace tests;

use Nuntius\Nuntius;

abstract class TestsAbstract extends \PHPUnit_Framework_TestCase {

  /**
   * @var \Nuntius\NuntiusRethinkdb
   */
  protected $rethinkdb;

  /**
   * @var string[]
   */
  protected $tables;

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    $this->rethinkdb = Nuntius::getRethinkDB();
  }

  /**
   * {@inheritdoc}
   */
  public function tearDown() {
    parent::tearDown();

    foreach (array_keys(Nuntius::getSettings()['entities']) as $table) {
      $this->rethinkdb->truncateTable($table);
    }
  }

}
