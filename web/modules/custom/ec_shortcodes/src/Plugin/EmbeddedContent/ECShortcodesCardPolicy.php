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
  public function defaultConfiguration() {
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
    return [
      '#theme' => 'ec_shortcodes_card_policy',
      '#kicker' => $this->configuration['kicker'],
      '#title' => $this->configuration['title'],
      '#src' => $this->configuration['src'],
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
      '#type' => 'url',
      '#title' => $this->t('Src'),
      '#default_value' => $this->configuration['url'],
      '#required' => TRUE,
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
