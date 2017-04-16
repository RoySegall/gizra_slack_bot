<?php

namespace Nuntius\Tasks;

use Nuntius\TaskConversationAbstract;
use Nuntius\TaskConversationInterface;

/**
 * Remind to the user something to do.
 */
class Introduction extends TaskConversationAbstract implements TaskConversationInterface {

  /**
   * The first name.
   *
   * @var string
   */
  public $firstName;

  /**
   * The last name.
   *
   * @var string
   */
  public $lastMame;

  /**
   * {@inheritdoc}
   */
  public function scope() {
    return [
      '/nice to meet you/' => [
        'human_command' => 'nice to meet you',
        'description' => 'We will do a proper introduction',
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
   * Get the user first name.
   */
  public function questionFirstName() {
    return 'what is you first name?';
  }

  /**
   * Get the last name of the user.
   */
  public function questionLastName() {
    return 'what is your last name?';
  }

  /**
   * {@inheritdoc}
   */
  public function collectAllAnswers() {
  }

}
