<?php

namespace Drupal\salsa_api;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Site\Settings;
use Drupal\Core\Url;
use GuzzleHttp\ClientInterface;

/**
 * Client to interact with the OMDb API.
 */
class ApiClient {

  /**
   * @var \GuzzleHttp\ClientInterface
   */
  protected $client;

  /**
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  private $configFactory;

  /**
   * Constructor.
   *
   * @param \GuzzleHttp\ClientInterface $client
   * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
   */
  public function __construct(ClientInterface $client, ConfigFactoryInterface $configFactory) {
    $this->client = $client;
    $this->configFactory = $configFactory;
  }

  /**
   * Get a movie by ID.
   *
   * @param \Drupal\omdb\string $id
   *
   * @return \stdClass
   */
  public function postUserData($data) {

    $settings = $this->getSettings();
    $config = $this->configFactory->get('salsa_api_form.settings');

    // Yeah, real one would be post, skipping that for expediency in the demo.
    // For this purpose, just showing we can grab the URL.
    $url = Url::fromUri($config->get('url'), ['query' => ['apiKey' => $settings['key']]]);

    return "OK";
  }

  /**
   * Returns the OMDb settings.
   *
   * @return array
   */
  protected function getSettings() {
    return Settings::get('salsa_api');
  }

}
