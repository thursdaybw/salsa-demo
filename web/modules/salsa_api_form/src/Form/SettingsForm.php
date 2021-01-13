<?php

namespace Drupal\salsa_api_form\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Salsa API Form settings for this site.
 *
 * Just a basic settings form where the api URL can be stored.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'salsa_api_form_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['salsa_api_form.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    // For these purposes, i'm not adding the api key to these settings/config.
    // I could, but requires extra work. For now store the API key in the
    // settings.php and assume that's written to by deploy systems.. poor man's
    // key file.
    $form['url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('API URL'),
      '#default_value' => $this->config('salsa_api_form.settings')->get('url'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // No validation for this example.
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('salsa_api_form.settings')
      ->set('url', $form_state->getValue('url'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
