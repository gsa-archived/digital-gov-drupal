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
 *   id = "ec_shortcodes_note_disclaimer",
 *   label = @Translation("Note - Disclaimer"),
 *   description = @Translation("Renders Note - Disclaimer component."),
 * )
 */
class ECShortcodesNoteDisclaimer extends EmbeddedContentPluginBase implements EmbeddedContentInterface {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'heading' => NULL,
      // 'type' => NULL,
      // 'text' => NULL,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    return [
      '#theme' => 'ec_shortcodes_note_disclaimer',
      '#heading' => $this->configuration['heading'],
      // '#type' => $this->configuration['type'],
      // '#text' => $this->configuration['text'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form['heading'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Note Heading'),
      '#default_value' => $this->configuration['heading'],
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
