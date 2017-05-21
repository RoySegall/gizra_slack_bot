<?php

namespace Nuntius\Tasks;

use Nuntius\Nuntius;
use Nuntius\TaskConversationAbstract;
use Nuntius\TaskConversationInterface;
use Slack\DirectMessageChannel;

/**
 * Notifying the team about something.
 */
class NotifyTeam extends TaskConversationAbstract implements TaskConversationInterface {

  /**
   * {@inheritdoc}
   */
  public function scope() {
    return [
      '/notify team/' => [
        'human_command' => 'notify team',
        'description' => 'Notify the team about something',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function conversationScope() {
    return 'forever';
  }

  /**
   * Get the team members.
   */
  public function questionGetTeamMembers() {
    return 'Who are your team members?';
  }

  /**
   * What should I notify the users.
   */
  public function questionWhatToSay() {
    return 'What should I tell them?';
  }

  /**
   * {@inheritdoc}
   */
  public function collectAllAnswers() {
    // Delete the context of that question.
    $row = $this->getTaskContext($this->taskId);

    $row['questions'] = $row['questions']->getArrayCopy();

    // Iterate over the team members and send them a message.
    $members = explode(',', $row['questions']['questionGetTeamMembers']);
    foreach ($members as $member) {
      $user = str_replace(['<@', '>'], '', $member);

      $this->client->getDMByUserId($user)->then(function (DirectMessageChannel $channel) use($row) {
        // Send the reminder.
        $text = "Hi, <@{$row['user']}> ask from me to tell you:\n{$row['questions']['questionWhatToSay']}";
        $this->client->send($text, $channel);
      });
    }

    // Delete the answer so nuntius will ask again next time what to notify.
    $row['questions']['questionWhatToSay'] = FALSE;
    $this->entityManager->get('context')->update($row['id'], $row);

    return 'I notified the team';
  }

}
