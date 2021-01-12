<?php

namespace Drupal\salsa_api_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a SalsaApiForm form.
 */
class ApiForm extends FormBase {

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
    if (mb_strlen($form_state->getValue('message')) < 10) {
      $form_state->setErrorByName('name', $this->t('Message should be at least 10 characters.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->messenger()->addStatus($this->t('The message has been sent.'));
    $form_state->setRedirect('<front>');
  }

}
