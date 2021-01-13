<?php

namespace Drupal\salsa_api;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Site\Settings;
use Drupal\Core\Url;
use GuzzleHttp\ClientInterface;

/**
 * Dummy client. Can use this to simulate calling an API.
 *
 * This is a super dummy for this purpose, it does very little except
 * return OK.
 */
class ApiClient {

  /**
   * HTTP client.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $client;

  /**
   * Access to configuration info.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  private $configFactory;

  /**
   * Constructor.
   *
   * @param \GuzzleHttp\ClientInterface $client
   *   HTTP client.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
   *   Config factory, give access to configuration data.
   */
  public function __construct(ClientInterface $client, ConfigFactoryInterface $configFactory) {
    $this->client = $client;
    $this->configFactory = $configFactory;
  }

  /**
   * Dummy method that would, but doesn't request a bearer token.
   *
   * For correct bearer token management we should authenticate with the API
   * here and retrieve a bearer token and store that temporally.
   * When the bearer token expires, then reauthenticate and retrieve a new
   * token.
   * Depending on the scope of the level of access token type in the API, we
   * may also require a refresh token. Implementation here depends on the
   * bearer token implementation in the API.
   *
   * It's also worth mentioning that all communicate that includes the bearer
   * token between this application and the API must be sent over HTTPS to
   * avoid the token being sniffed in transit.
   *
   * @return string
   *   String representation of bearer token.
   */
  private function getToken(): string {
    return "sometoken";
  }

  /**
   * Get a movie by ID.
   *
   * @param array $data
   *   Some data to post. But we don't in this demo.
   *
   * @return string
   *   A simple string return for demo purposes, just "OK".
   */
  public function postUserData(array $data = []) {

    $token = $this->getToken();

    $api_key = $this->getApiKey();
    $config = $this->configFactory->get('salsa_api_form.settings');

    // Get the URL for the API from configuration and append the API key to
    // the query.
    // Just a very sample get (not even a post).
    //
    // Ignoring this code as we don't use this $url variable and that generates
    // an error.
    // @codingStandardsIgnoreStart
    $url = Url::fromUri(
      $config->get('url'),
    );
    // @codingStandardsIgnoreEnd

    $fields_string = json_encode($data);

    /*
     * Don't actually send the post, it will fail.
     *
     * We would do this:
     *   $response = $this->client->post($url, [
     */
    return $this->post($url->getUri(), [
      'api_key' => $api_key,
      'body' => $fields_string,
      'http_errors' => FALSE,
      'headers' => [
        'Content-Type' => 'application/json',
        $headers = [
          'Authorization' => 'Bearer ' . $token,
          'Accept'        => 'application/json',
        ],
      ],
    ]);

  }

  /**
   * Get the API Key from settings.php.
   *
   * This is a simple way to store the api key.
   * This only works if settings.php is not comitted to git
   * and also relies on related technologies not exposing settings.php
   * to access from outside. There are better/other solutions around depending
   * on the context of the project, where it's hosted.
   * For example, the key module: https://www.drupal.org/project/key connected
   * to an external key management solution.
   *
   * @return mixed
   *   Return type depends on the value in the settings.
   *   It should be a string.
   */
  protected function getApiKey() {
    return Settings::get('salsa_api_key');
  }

  /**
   * Dummy post, call this instead of the one on http_client.
   *
   * @param string $uri
   *   Url to submit to.
   * @param array $options
   *   Options for the post request.
   *
   * @return \GuzzleHttp\Psr7\Response
   *   Would return a response, for this demo, i'm just returning a string.
   */
  protected function post(string $uri, array $options = []) {
    return "OK";
  }

}
