<?php

namespace Nuntius\Dispatcher;

use Nuntius\NuntiusEventDispatchSetDataTrait;
use Symfony\Component\EventDispatcher\Event;

class GitHubEvent extends Event {

  use NuntiusEventDispatchSetDataTrait;

}
