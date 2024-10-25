<?php

namespace Drupal\ec_shortcodes\Plugin\EmbeddedContent;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\embedded_content\EmbeddedContentInterface;
use Drupal\embedded_content\EmbeddedContentPluginBase;
use Drupal\multivalue_form_element\Element\MultiValue;

/**
 * Plugin iframes.
 *
 * @EmbeddedContent(
 *   id = "ec_shortcodes_checklist",
 *   label = @Translation("Checklist"),
 *   description = @Translation("Renders a checklist."),
 * )
 */
class ECShortcodesChecklist extends EmbeddedContentPluginBase implements EmbeddedContentInterface {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'checklist' => NULL,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    return [
      '#theme' => 'ec_shortcodes_checklist',
      '#checklist' => $this->configuration['checklist'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form['checklist'] = [
      '#type' => 'multivalue',
      '#title' => $this->t('Checkbox List'),
      '#cardinality' => MultiValue::CARDINALITY_UNLIMITED,
      '#default_value' => $this->configuration['checklist'],
      'checkbox' => [
        '#type' => 'textfield',
        '#title' => $this->t('Checkbox text'),
      ],
      'sublist' => [
        '#type' => 'textarea',
        '#title' => $this->t('Sublist'),
        '#description' => $this->t('Add each bullet point as a new line')
      ],
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
