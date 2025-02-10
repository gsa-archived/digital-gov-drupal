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
 *   id = "ec_shortcodes_card_policy",
 *   label = @Translation("Card Policy"),
 *   description = @Translation("Renders an accordion with policy."),
 * )
 */
class ECShortcodesCardPolicy extends EmbeddedContentPluginBase implements EmbeddedContentInterface {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration(): array {
    return [
      'kicker' => NULL,
      'title' => NULL,
      'src' => NULL,
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
      '#theme' => 'ec_shortcodes_card_policy',
      '#kicker' => $this->configuration['kicker'],
      '#title' => $this->configuration['title'],
      '#url' => $url,
      '#text' => $this->configuration['text'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form['kicker'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Kicker'),
      '#default_value' => $this->configuration['kicker'],
      '#required' => TRUE,
    ];
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->configuration['title'],
      '#required' => TRUE,
    ];
    $form['url'] = [
      '#title' => $this->t('URL'),
      '#description' => $this->t('Used in link at end of card.. Enter a title to find an internal page or enter an external URL.'),
      '#default_value' => $this->configuration['url'] ?? '',
      '#required' => TRUE,
      '#type' => 'linkit',
      '#autocomplete_route_name' => 'linkit.autocomplete',
      '#autocomplete_route_parameters' => [
        'linkit_profile_id' => 'default',
      ],
    ];
    $form['text'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Body'),
      '#default_value' => $this->configuration['text']['value'] ?? '',
      '#format' => 'multiline_inline_html',
      '#allowed_formats' => ['multiline_inline_html'],
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
