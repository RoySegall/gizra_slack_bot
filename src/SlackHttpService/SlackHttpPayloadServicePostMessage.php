<?php

namespace SlackHttpService;

/**
 * Post message payload object.
 */
class SlackHttpPayloadServicePostMessage extends SlackHttpPayloadServiceAbstract {

  /**
   * Set the channel.
   *
   * @param $channel
   *   The channel.
   *
   * @return SlackHttpPayloadServicePostMessage
   *   The current instance.
   */
  public function setChannel($channel) {
    $this->payload['channel'] = $channel;
    return $this;
  }

  /**
   * Set the text of the message.
   *
   * @param $text
   *   The message.
   *
   * @return SlackHttpPayloadServicePostMessage
   *   The current instance.
   */
  public function setText($text) {
    $this->payload['text'] = $text;
    return $this;
  }

  public function setParse() {
    return $this;
  }

  public function setLinkNames() {
    return $this;
  }

  public function setAttachments() {
    return $this;
  }

  public function setUnfurlLinks() {
    return $this;
  }

  public function setUnfurlMedia() {
    return $this;
  }

  public function setUsername() {
    return $this;
  }

  public function setAsUser() {
    return $this;
  }

  public function setIconUrl() {
    return $this;
  }

  public function setIconEmoji() {
    return $this;
  }

  public function setThreadTs() {

  }

  public function setReplyBroadcast() {

  }

}
