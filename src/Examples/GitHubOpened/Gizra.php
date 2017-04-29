<?php

namespace Nuntius\Examples\GitHubOpened;

use Nuntius\Dispatcher\GitHubEvent;
use Nuntius\Nuntius;
use Slack\ChannelInterface;

class Gizra {

  public function Notify(GitHubEvent $event) {
    $client = Nuntius::bootstrap();

    $client->getUserByName('roysegall')->then(function (ChannelInterface $channel) use ($client) {
      $client->send('Hi user!', $channel);
    });
  }

}