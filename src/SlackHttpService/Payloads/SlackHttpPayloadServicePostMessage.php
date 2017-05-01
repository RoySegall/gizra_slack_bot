<?php

namespace SlackHttpService\Payloads;

/**
 * Post message payload object.
 */
class SlackHttpPayloadServicePostMessage extends SlackHttpPayloadServiceAbstract {

  /**
   * {@inheritdoc}
   */
  protected function setDefaults() {
    $this->payload = [];
  }

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

  /**
   * Set the parse.
   *
   * @param $parse
   *   The parse value.
   *
   * @return SlackHttpPayloadServicePostMessage
   *   The current instance.
   */
  public function setParse($parse) {
    $this->payload['parse'] = $parse;

    return $this;
  }

  /**
   * Set links names.
   *
   * @param $link_names
   *   The links names.
   *
   * @return SlackHttpPayloadServicePostMessage
   *   The current instance.
   */
  public function setLinkNames($link_names) {
    $this->payload['link_names'] = $link_names;

    return $this;
  }

  /**
   * Set the attachment.
   *
   * @param SlackHttpPayloadServiceAttachments[] $attachments
   *   The attachment array.
   *
   * @return SlackHttpPayloadServicePostMessage
   *   The current instance.
   */
  public function setAttachments(array $attachments) {

    foreach ($attachments as $key => $attachment) {
      $this->payload['attachments'][$key] = $attachment->getPayload();
    }

    return $this;
  }

  /**
   * Set the unfurl links.
   *
   * @param $unfurl_links
   *   The unfurl links.
   *
   * @return SlackHttpPayloadServicePostMessage
   *   The current instance.
   */
  public function setUnfurlLinks($unfurl_links) {
    $this->payload['unfurl_links'] = $unfurl_links;

    return $this;
  }

  /**
   * Set the unfurl links.
   *
   * @param $unfurl_links
   *   The unfurl links.
   *
   * @return SlackHttpPayloadServicePostMessage
   *   The current instance.
   */
  public function setUnfurlMedia($unfurl_links) {
    $this->payload['unfurl_links'] = $unfurl_links;

    return $this;
  }

  /**
   * Set the username.
   *
   * @param $username
   *   The username.
   *
   * @return SlackHttpPayloadServicePostMessage
   *   The current instance.
   */
  public function setUsername($username) {
    $this->payload['username'] = $username;

    return $this;
  }

  /**
   * Set the as user.
   *
   * @param $as_user
   *   The as user.
   *
   * @return SlackHttpPayloadServicePostMessage
   *   The current instance.
   */
  public function setAsUser($as_user) {
    $this->payload['as_user'] = $as_user;

    return $this;
  }

  /**
   * Set the icon URL.
   *
   * @param $icon_url
   *   The icon url.
   *
   * @return SlackHttpPayloadServicePostMessage
   *   The current instance.
   */
  public function setIconUrl($icon_url) {
    $this->payload['icon_url'] = $icon_url;

    return $this;
  }

  /**
   * Set the emoji icon.
   *
   * @param $icon_emoji
   *   The emoji icon.
   *
   * @return SlackHttpPayloadServicePostMessage
   *   The current instance.
   */
  public function setIconEmoji($icon_emoji) {
    $this->payload['icon_emoji'] = $icon_emoji;

    return $this;
  }

  /**
   * Set the thread ts.
   *
   * @param $thread_ts
   *   The thread ts.
   *
   * @return SlackHttpPayloadServicePostMessage
   *   The current instance.
   */
  public function setThreadTs($thread_ts) {
    $this->payload['thread_ts'] = $thread_ts;

    return $this;
  }

  /**
   * Set the reply brod cast.
   *
   * @param $reply_broadcast
   *   The reply brod cast.
   *
   * @return SlackHttpPayloadServicePostMessage
   *   The current instance.
   */
  public function setReplyBroadcast($reply_broadcast) {
    $this->payload['reply_broadcast'] = $reply_broadcast;

    return $this;
  }

}
