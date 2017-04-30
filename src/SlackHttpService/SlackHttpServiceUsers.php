<?php

namespace SlackHttpService;

/**
 * Handle the users part of the rest api with slack.
 */
class SlackHttpServiceUsers extends SlackHttpServiceHandlerAbstract {

  /**
   * {@inheritdoc}
   */
  protected $main_api = 'users';

  /**
   * Get list of user and information.
   *
   * @return \stdClass
   *   The JSON representation of the user list request.
   */
  public function getList() {
    return $this->decodeApiRequest('list');
  }

  /**
   * Get user by name.
   *
   * @param string $id
   *   The name.
   *
   * @return \stdClass
   *   The JSON representation of the user list request.
   */
  public function getUserById($id) {
    return $this->slackHttpService->requestWithArguments('users.list', ['user' => $id]);
  }

}
