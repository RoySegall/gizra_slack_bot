<?php

namespace SlackHttpService;

/**
 * Base class to all payload objects.
 */
abstract class SlackHttpPayloadServiceAbstract {

  /**
   * The payload object.
   *
   * @var array
   */
  protected $payload = [];

  /**
   * Get the payload.
   *
   * @return array
   *   Get the payload.
   */
  public function getPayload() {
    return $this->payload;
  }

}
