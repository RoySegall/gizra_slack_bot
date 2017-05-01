<?php

namespace Nuntius\Examples\GitHubOpened;

use Nuntius\Dispatcher\GitHubEvent;
use Nuntius\Dispatcher\GitHubOpenedEventInterface;
use Nuntius\Nuntius;
use SlackHttpService\Payloads\SlackHttpPayloadServiceAttachments;
use SlackHttpService\Payloads\SlackHttpPayloadServicePostMessage;
use SlackHttpService\SlackHttpService;

class NuntiusGitHubOpenedExample implements GitHubOpenedEventInterface {

  /**
   * {@inheritdoc}
   */
  public function act(GitHubEvent $event) {
    $data = $event->getData();

    $key = empty($data->pull_request) ? 'issue' : 'pull_request';

    $info = [
      'image' => $data->{$key}->user->avatar_url,
      'username' => $data->{$key}->user->login,
      'url' => $data->{$key}->html_url,
      'title' => $data->{$key}->title,
      'body' => $data->{$key}->body,
      'created' => $data->{$key}->created_at,
    ];

    $info['text'] = 'Hi ' . $info['username'];
    $info['text'] .= $key == 'issue' ? ', You created an issue' : ', You created a PR';

    $info['footer'] = 'Created at ' . $info['created'];

    $this->postMessage($info);
  }

  /**
   * Posting the message.
   *
   * @param $info
   *   Information relate to
   */
  protected function postMessage($info) {
    $slack_http = new SlackHttpService();
    $slack = $slack_http->setAccessToken(Nuntius::getSettings()->getSetting('access_token'));
    $im = $slack->Im()->getImForUser($slack->Users()->getUserByName(strtolower($info['username'])));

    $attachment = new SlackHttpPayloadServiceAttachments();
    $attachment
      ->setColor('#36a64f')
      ->setTitle($info['title'])
      ->setTitleLink($info['url'])
      ->setText($info['body'])
      ->setThumbUrl($info['image'])
      ->setFooter($info['footer']);

    $attachments[] = $attachment;

    $message = new SlackHttpPayloadServicePostMessage();
    $message
      ->setChannel($im)
      ->setAttachments($attachments)
      ->setText($info['text']);

    $slack->Chat()->postMessage($message);
  }

}