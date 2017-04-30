<?php

namespace Nuntius\Examples\GitHubOpened;

use Nuntius\Dispatcher\GitHubEvent;
use Nuntius\Nuntius;

class Gizra {

  public function Notify(GitHubEvent $event) {

    $slack_http = new \SlackHttpService\SlackHttpService();
    $response = $slack_http
      ->setAccessToken(Nuntius::getSettings()->getSetting('access_token'))
      ->Users()->getList();

    \Kint::dump($response);

    $user = $slack_http
      ->setAccessToken(Nuntius::getSettings()->getSetting('access_token'))
      ->Users()->getUserByName('roysegall');

    \Kint::dump($user);

  }

}