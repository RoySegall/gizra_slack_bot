# Nuntius slack bot
Gizra became a company when a lot of the employees are remote: USA, 
Canada, Spain and the list goes on. That status required from us to start using 
Slack. But the problem is that we wanted Slack to be cool. The obvious idea is 
to have a bot. The bot will interact with us and might improve the way we 
communicates.

## Origin
Like any awesome super hero, Nuntius have an origin story. It's not a tragic 
origin story when his uncle-CPU died due to lack of understanding that with 
great power comes great responsibility.

Nuntius in Latin means messages. That was the original project - a chat based on
any backend technology: Drupal, Wordpress, NodeJS, etc., etc. that could connect
to any front end technology(React, Elm, Angular, etc., etc.) and using any 
websocket service(Socket.IO, Pusher, FireBase). The project was too much for a 
single man but the name lived on.

## Set up.
You'll need PHP 5.6 and above, [Composer](http://getcomposer.org) and 
[RethinkDB](http://rethinkdb.com).

After creating a bot, Go to `https://YOURTEAM.slack.com/apps`. Click on `Manage`
and under `Custom integration` you'll see your bot. Click on the bot to get the
access token.

```bash
cp settings.local.example.yml settings.local.yml
composer install
rethinkdb
```

Open the settings file you created and set the token you copied, and run:
```bash
php console.php nuntius:install
php bot.php
```

That's it. Nuntius is up and running.

## Integrating
Integration can be done through the main `settings.yml` file(or in case you
forked the project through the `settings.local.yml`). The `settings.local.yml`
file will override settings of the `settings.yml` file. In that case you can
override entities, tasks, RTM events, commands and updates.

Let's go through the different integrations.

## Events
Integration with slack can be achieved in various ways. Nuntius implementing the
integration via websocket and push events AKA RTM events. For any operation on
slack there is a matching RTM event. You can look on the list 
[here](https://api.slack.com/rtm#events).

Let's see how to interact with the message events. In the `settings.yml` we have
the `events` section:
```yml
events:
  presence_change: '\Nuntius\Plugin\PresenceChange'
  message: '\Nuntius\Plugin\Message'
```

The `message` key paired with the namespace for the class that need to implement
the logic for the events. Let's have a look at the code:

```php
<?php

namespace Nuntius\Plugin;

/**
 * Class Message.
 *
 * Triggered when a message eas sent.
 */
class Message extends NuntiusPluginAbstract {

  /**
   * {@inheritdoc}
   */
  public function action() {
    // code here...
  }
  
}
```

Everytime someone will send a message the action method will be invoked.
