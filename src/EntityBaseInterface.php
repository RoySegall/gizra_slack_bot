<?php

namespace Nuntius;

/**
 * Interface EntityBaseInterface.
 */
interface EntityBaseInterface {

  /**
   * Loading all the entities.
   *
   * @return array
   *   List of entities.
   */
  public function loadAll();

  /**
   * Load a single entities.
   *
   * @param $id
   *   Entity ID.
   *
   * @return array
   *   The entity.
   */
  public function load($id);

  /**
   * Inert an entry to the DB.
   *
   * @param array $item
   *   The item to insert into the DB.
   */
  public function insert(array $item);

  /**
   * Delete an entry from the DB.
   *
   * @param $id
   *   The entity ID.
   */
  public function delete($id);

  /**
   * Updating an entry in the DB.
   *
   * @param $id
   *   The entity ID.
   * @param $data
   *   The data to update.
   */
  public function update($id, $data);

}
