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
 *   id = "ec_shortcodes_author_bio",
 *   label = @Translation("Author Bio"),
 *   description = @Translation("Renders Author bio content."),
 * )
 */
class ECShortcodesAuthorBio extends EmbeddedContentPluginBase implements EmbeddedContentInterface {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'name' => NULL,
      'bio' => NULL,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    return [
      '#theme' => 'ec_shortcodes_author_bio',
      // '#name' => $this->configuration['name'],
      // '#bio' => $this->configuration['bio'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    // $form['name'] = [
    //   '#type' => 'textfield',
    //   '#title' => $this->t('Name'),
    //   '#default_value' => $this->configuration['name'],
    //   '#required' => TRUE,
    // ];
    // $form['bio'] = [
    //   '#type' => 'textfield',
    //   '#title' => $this->t('Bio'),
    //   '#default_value' => $this->configuration['bio'],
    //   '#required' => TRUE,
    // ];

  //   $form['author'] = [
  //       '#type' => 'entity_autocomplete',
  //       '#target_type' => 'node',
  //       '#tags' => TRUE,
  //       '#default_value' => $node,
  //       '#selection_handler' => 'default',
  //       '#selection_settings' => [
  //         'target_bundles' => ['authors'],
  //         ],
  //       '#autocreate' => [
  //         'bundle' => 'article',
  //         // 'uid' => <a valid user ID>,
  // ],
// ];

$form['author'] = [
  '#type' => 'entity_autocomplete',
  '#target_type' => 'node',
  '#tags' => TRUE,
  '#default_value' => $node,
  '#selection_handler' => 'default',
  '#selection_settings' => [
    'target_bundles' => ['authors'],
  ],
  '#autocreate' => [
    'bundle' => 'article',
    // 'uid' => <a valid user ID>,
  ],
  '#process' => function ($element, &$form_state, $form) {
    $node = \Drupal::entityTypeManager()->getStorage('node')->load($element['#value']);
    if ($node) {
      $element['#value'] = [
        'nid' => $node->id(),
        'field_bio' => $node->field_bio->value,
        'field_first_name' => $node->field_first_name->value,
        'field_last_name' => $node->field_last_name->value,
      ];
    }
    return $element;
  },
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
