<?php

namespace SlackHttpService;

/**
 * Handle the chat part of the rest api with slack.
 */
class SlackHttpServiceChat extends SlackHttpServiceHandlerAbstract {

  /**
   * {@inheritdoc}
   */
  protected $mainApi = 'chat';

  /**
   * Posting a message to a room.
   *
   * @param SlackHttpPayloadServicePostMessage $message
   *   The post message payload object.
   *
   * @return \stdClass
   */
  public function postMessage(SlackHttpPayloadServicePostMessage $message) {
    return $this->decodeRequest($this->slackHttpService->requestWithArguments($this->mainApi . '.' . 'postMessage', $message->getPayload()));
  }

}
