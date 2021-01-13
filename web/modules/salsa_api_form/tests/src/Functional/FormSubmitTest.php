<?php

namespace Drupal\Tests\salsa_api_form\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Test description.
 *
 * @group salsa_api_form
 */
class FormSubmitTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stable';

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['salsa_api_form'];

  /**
   * {@inheritdoc}
   */
  protected function setUp() : void {
    parent::setUp();
    // Set up the test here.
  }

  /**
   * Test callback.
   */
  public function testSomethingblah() {
    $user = $this->drupalCreateUser(['access content']);
    $this->drupalLogin($user);

    $this->drupalGet('salsa-api-form');
    $this->assertSession()->elementExists('css', '#edit-first-name');
  }

}
