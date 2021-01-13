<?php

namespace Drupal\salsa_api_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\salsa_api\ApiClient;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a SalsaApiForm form.
 */
class ApiForm extends FormBase {

  /**
   * Our dummy API Client.
   *
   * Our form will call this client's postUserData method on submit.
   *
   * @var \Drupal\salsa_api\ApiClient
   */
  private $apiClient;

  /**
   * Class constructor.
   *
   * @param \Drupal\salsa_api\ApiClient $apiClient
   *   Dummy API client.
   */
  public function __construct(ApiClient $apiClient) {
    $this->apiClient = $apiClient;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    // Instantiates this form class.
    /** @var Drupal\salsa_api\ApiClient $container */
    return new static(
      // Load the service required to construct this class.
      $container->get('salsa_api.api_client')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'salsa_api_form_api';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First name'),
      '#required' => TRUE,
    ];

    $form['last_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Last name'),
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email'),
      '#required' => TRUE,
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Send'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Validation.. skipping for this example.
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->messenger()->addStatus($this->t('The details have been saved to the API'));

    // Call the post request on the api client.
    // For demo I have no sent the form data, it would be ignored anyway.
    $this->apiClient->postUserData([]);

    $form_state->setRedirect('<front>');
  }

}
