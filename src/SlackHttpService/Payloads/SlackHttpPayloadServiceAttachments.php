<?php

namespace SlackHttpService\Payloads;

/**
 * Post message attachment values.
 */
class SlackHttpPayloadServiceAttachments extends SlackHttpPayloadServiceAbstract {

  /**
   * {@inheritdoc}
   */
  protected function setDefaults() {
    $this->payload = [];
  }

}
