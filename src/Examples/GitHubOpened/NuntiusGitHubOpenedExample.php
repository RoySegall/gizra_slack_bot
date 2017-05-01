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

    if (!empty($data->pull_request)) {
      $info = [
        'image' => $data->pull_request->user->avatar_url,
        'username' => $data->pull_request->user->login,
        'url' => $data->pull_request->url,
        'title' => $data->pull_request->title,
      ];

      $info['text'] = 'Hi ' . $info['username'] . ', You create a PR <' . $info['url'] . '|' . $info['title'] . '>';
    }

    $slack_http = new SlackHttpService();
    $slack = $slack_http->setAccessToken(Nuntius::getSettings()->getSetting('access_token'));
    $im = $slack->Im()->getImForUser($slack->Users()->getUserByName(strtolower($info['username'])));

    $message = new SlackHttpPayloadServicePostMessage();
    $message
      ->setChannel($im)
      ->setText($info['text']);

    return;
    $slack_http = new SlackHttpService();

    $slack = $slack_http->setAccessToken(Nuntius::getSettings()->getSetting('access_token'));
    $im = $slack->Im()->getImForUser($slack->Users()->getUserByName('roysegall'));

    $attachment = new SlackHttpPayloadServiceAttachments();
    $attachment
      ->setText('foo')
      ->setColor('#ff9900')
      ->setTitle('New PR')
      ->setTitle('http://google.com')
      ->setImageUrl();

    $attachments[] = $attachment;


    \Kint::dump($slack->Chat()->postMessage($message));
  }

}