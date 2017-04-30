<?php

namespace Nuntius\Examples\GitHubOpened;

use Nuntius\Dispatcher\GitHubEvent;
use Nuntius\Nuntius;
use SlackHttpService\SlackHttpPayloadServicePostMessage;

class Gizra {

  public function Notify(GitHubEvent $event) {

    $slack_http = new \SlackHttpService\SlackHttpService();

    $slack = $slack_http->setAccessToken(Nuntius::getSettings()->getSetting('access_token'));
    $im = $slack->Im()->getImForUser($slack->Users()->getUserByName('roysegall'));

    $message = new SlackHttpPayloadServicePostMessage();
    $message
      ->setChannel($im)
      ->setText('Hi Roy Segall! you pushed a commit to PR <http://www.foo.com|PR title>');
    $slack->Chat()->postMessage($message);
  }

}