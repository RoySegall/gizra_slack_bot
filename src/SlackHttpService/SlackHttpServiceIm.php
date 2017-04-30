<?php

namespace SlackHttpService;

/**
 * Handle the IM part of the rest api with slack.
 */
class SlackHttpServiceIm extends SlackHttpServiceHandlerAbstract {

  /**
   * {@inheritdoc}
   */
  protected $main_api = 'im';

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
   * Get the IM room of a user.
   *
   * @param \stdClass $user
   *   The user object.
   *
   * @return string
   *   The string of the IM room.
   */
  public function getImForUser(\stdClass $user) {
    $ims_filtered = array_filter(array_map(function($im_room) use ($user) {
      if ($im_room->user == $user->id) {
        return $im_room->id;
      }
      return;
    }, $this->getList()->ims));

    return reset($ims_filtered);
  }

}
