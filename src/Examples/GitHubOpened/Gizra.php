<?php

namespace Nuntius\Examples\GitHubOpened;

use Nuntius\Dispatcher\GitHubEvent;
use Nuntius\Nuntius;
use SlackHttpService\Payloads\SlackHttpPayloadServiceAttachments;
use SlackHttpService\Payloads\SlackHttpPayloadServicePostMessage;
use SlackHttpService\SlackHttpService;

class Gizra {

  public function Notify(GitHubEvent $event) {

    $slack_http = new SlackHttpService();

    $slack = $slack_http->setAccessToken(Nuntius::getSettings()->getSetting('access_token'));
    $im = $slack->Im()->getImForUser($slack->Users()->getUserByName('roysegall'));

    $attachment = new SlackHttpPayloadServiceAttachments();
    $attachment
      ->setText('foo')
      ->setColor('#ff9900')
      ->setTitle('New PR')
      ->setTitle('http://google.com');

    $attachments[] = $attachment;

    $message = new SlackHttpPayloadServicePostMessage();
    $message
      ->setChannel($im)
      ->setText('Hi Roy Segall! you pushed a commit to PR <http://www.foo.com|PR title>')
      ->setAttachments($attachments);

    \Kint::dump($slack->Chat()->postMessage($message));
  }

}