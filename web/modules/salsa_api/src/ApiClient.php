<?php

namespace Drupal\salsa_api;

/**
 * @file
 * Defines a dummy api client to talk to a null api endpoint.
 */

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
   * Get a movie by ID.
   *
   * @param array $data
   *   Some data to post. But we don't in this demo.
   *
   * @return string
   *   A simple string return for demo purposes, just "OK".
   */
  public function postUserData(array $data = []) {

    $settings = $this->getApiKey();
    $config = $this->configFactory->get('salsa_api_form.settings');

    // Get the URL for the API from configuration and append the API key to
    // the query.
    // Just a very sample get (not even a post).
    $url = Url::fromUri(
      $config->get('url'),
      [
        'query' => [
          'apiKey' => $settings['salsa_api_key'],
        ],
      ]
    );

    return "OK";
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

}
