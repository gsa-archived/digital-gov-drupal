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
 *   id = "ec_shortcodes_card_prompt",
 *   label = @Translation("Card Prompt"),
 *   description = @Translation("Renders an card with a prompt."),
 * )
 */
class ECShortcodesCardPrompt extends EmbeddedContentPluginBase implements EmbeddedContentInterface {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'intro' => NULL,
      'prompt' => NULL,
      'text' => NULL,
      'url' => NULL,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    return [
      '#theme' => 'ec_shortcodes_card_prompt',
      '#intro' => $this->configuration['intro'],
      '#prompt' => $this->configuration['prompt'],
      '#text' => $this->configuration['text'],
      '#url' => $this->configuration['url'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form['intro'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Intro'),
      '#format' => 'multiline_inline_html',
      '#allowed_formats' => ['multiline_inline_html'],
      '#default_value' => $this->configuration['intro']['value'] ?? '',
      '#required' => TRUE,
    ];
    $form['prompt'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Prompt'),
      '#format' => 'html_embedded_content',
      '#allowed_formats' => ['html_embedded_content'],
      '#default_value' => $this->configuration['prompt']['value'] ?? '',
      '#required' => TRUE,
    ];
    $form['text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Button Text'),
      '#default_value' => $this->configuration['text'],
      '#required' => TRUE,
    ];
    $form['url'] = [
      '#type' => 'url',
      '#title' => $this->t('Button Url'),
      '#default_value' => $this->configuration['url'],
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
