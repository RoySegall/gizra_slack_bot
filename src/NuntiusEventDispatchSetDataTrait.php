<?php

namespace Nuntius;

trait NuntiusEventDispatchSetDataTrait {

  /**
   * Event data.
   *
   * @var array
   */
  protected $data = [];

  /**
   * Set data.
   *
   * @param array $data
   *   Event data.
   *
   * @return $this
   *   The current instance.
   */
  public function setData($data) {
    $this->data = $data;

    return $this;
  }

  /**
   * Get data for the event.
   *
   * @return array
   *   The event data.
   */
  public function getData() {
    return $this->data;
  }

}
