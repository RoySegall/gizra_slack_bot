<?php

namespace Nuntius\Tasks;

use Nuntius\TaskBaseAbstract;
use Nuntius\TaskBaseInterface;
use Slack\DirectMessageChannel;

/**
 * Remind to the user something to do.
 */
class Reminders extends TaskBaseAbstract implements TaskBaseInterface {

  /**
   * {@inheritdoc}
   */
  public function scope() {
    return [
      '/remind me (.*)/' => [
        'human_command' => 'remind me REMINDER',
        'description' => 'Next time you log in I will remind you what you '
        . ' wrote in the REMINDER',
        'callback' => 'addReminder',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function actOnPresenceChange() {
    if ($this->data['presence'] == 'away') {
      return;
    }

    $rows = $this->db
      ->getTable('reminders')
      ->filter(\r\row('user')->eq($this->data['user']))
      ->run($this->db->getConnection());

    foreach ($rows as $row) {
      $result = $row->getArrayCopy();

      $this->client->getDMByUserId($result['user'])->then(function (DirectMessageChannel $channel) use ($result) {
        // Send the reminder.
        $text = 'Hi! You asked me to remind you: ' . $result['reminder'];
        $this->client->send($text, $channel);

        // Delete the reminder from the DB.
        $this->entityManager->get('reminders')->delete($result['id']);
      });
    }
  }

  /**
   * Adding a reminder to the DB.
   *
   * @param string $reminder
   *   The reminder of the user.
   *
   * @return string
   *   You got it dude!
   */
  public function addReminder($reminder) {
    $this
      ->entityManager
      ->get('reminders')
      ->insert([
        'reminder' => $reminder,
        'user' => $this->data['user'],
      ]);

    return 'OK! I got you covered!';
  }

}