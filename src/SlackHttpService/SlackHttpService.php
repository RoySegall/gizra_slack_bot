<?php

namespace SlackHttpService;

/**
 * Main controller for the Slack HTTP request manager.
 */
class SlackHttpService {

  /**
   * Access token of the integration.
   *
   * @var string
   */
  protected $accessToken;

  /**
   * HTTP client.
   *
   * @var \GuzzleHttp\Client
   */
  protected $http;

  /**
   * Constructing the service.
   */
  function __construct() {
    $this->http = new \GuzzleHttp\Client();
  }

  /**
   * Get the access token.
   *
   * @return string
   */
  public function getAccessToken() {
    return $this->accessToken;
  }

  /**
   * Set the access token.
   *
   * @param string $accessToken
   *   Set the access token.
   *
   * @return SlackHttpService
   */
  public function setAccessToken($accessToken) {
    $this->accessToken = $accessToken;

    return $this;
  }

  /**
   * Apply request to slack HTTP api.
   *
   * @param string $api
   *   The api of slack - user.list, user.info etc. etc.
   *
   * @return \Psr\Http\Message\ResponseInterface
   *   The response interface.
   */
  public function request($api) {
    return $this->http->request('get', 'https://slack.com/api/' . $api, ['query' => ['token' => $this->accessToken]]);
  }

  /**
   * Apply request to slack HTTP api.
   *
   * @param string $api
   *   The api of slack - user.list, user.info etc. etc.
   * @param array $arguments
   *   Passing arguments in the request for a end point with arguments.
   *
   * @return \Psr\Http\Message\ResponseInterface
   *   The response interface.
   */
  public function requestWithArguments($api, array $arguments) {
    return $this->http->request('get', 'https://slack.com/api/' . $api, ['query' => ['token' => $this->accessToken] + $arguments]);
  }

  /**
   * Get the users api controller.
   *
   * @return SlackHttpServiceUsers
   *   The user service.
   */
  public function Users() {
    return new SlackHttpServiceUsers($this);
  }

}
