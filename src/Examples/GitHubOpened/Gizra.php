<?php

namespace Nuntius\Examples\GitHubOpened;

use Nuntius\Dispatcher\GitHubEvent;
use Nuntius\Nuntius;

class Gizra {

  public function Notify(GitHubEvent $event) {

    $slack_http = new \SlackHttpService\SlackHttpService();
    $slack = $slack_http->setAccessToken(Nuntius::getSettings()->getSetting('access_token'));
    $im = $slack->Im()->getImForUser($slack->Users()->getUserByName('roysegall'));
  }

}