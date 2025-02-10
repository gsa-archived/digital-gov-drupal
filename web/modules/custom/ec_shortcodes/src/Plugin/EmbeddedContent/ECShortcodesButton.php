<?php

namespace Drupal\ec_shortcodes\Plugin\EmbeddedContent;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\embedded_content\EmbeddedContentInterface;
use Drupal\embedded_content\EmbeddedContentPluginBase;

/**
 * Plugin iframes.
 *
 * @EmbeddedContent(
 *   id = "ec_shortcodes_button",
 *   label = @Translation("Button"),
 *   description = @Translation("Renders a button."),
 * )
 */
class ECShortcodesButton extends EmbeddedContentPluginBase implements EmbeddedContentInterface {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'url' => NULL,
      'text' => NULL,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $url = $this->configuration['url'];
    // A URL starting with two slashes is a protocol relative external link.
    if (str_starts_with($url, '/') && !str_starts_with($url, '//')) {
      $url = \Drupal::service('path_alias.manager')->getAliasByPath($url);
    }

    return [
      '#theme' => 'ec_shortcodes_button',
      '#url' => $url,
      '#text' => $this->configuration['text'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form['url'] = [
      '#title' => $this->t('Button URL'),
      '#default_value' => $this->configuration['url'],
      '#required' => TRUE,
      '#description' => $this->t('Enter a title to find an internal page or enter an external URL.'),
      '#type' => 'linkit',
      '#autocomplete_route_name' => 'linkit.autocomplete',
      '#autocomplete_route_parameters' => [
        'linkit_profile_id' => 'default',
      ],
    ];
    $form['text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Text'),
      '#default_value' => $this->configuration['text'],
      '#description' => $this->t('Text for the button label.'),
      '#required' => TRUE,
    ];
    return $form;
  }

  /**
   * {@inheritDoc}
   */
  public function isInline(): bool {
    return FALSE;
  }

}
