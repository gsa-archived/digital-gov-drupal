<?php

namespace Drupal\ec_shortcodes\Plugin\EmbeddedContent;

use Drupal\embedded_content\EmbeddedContentInterface;
use Drupal\embedded_content\EmbeddedContentPluginBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * Plugin iframes.
 *
 * @EmbeddedContent(
 *   id = "ec_shortcodes_checkbox",
 *   label = @Translation("Checkbox"),
 *   description = @Translation("Renders a checkbox with text."),
 * )
 */
class ECShortcodesCheckbox extends EmbeddedContentPluginBase implements EmbeddedContentInterface
{

    use StringTranslationTrait;

    /**
     * {@inheritdoc}
     */
    public function defaultConfiguration()
    {
        return [
        'url' => NULL,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function build(): array
    {
        return [
        '#theme' => 'ec_shortcodes_checkbox',
        '#text' => $this->configuration['text'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function buildConfigurationForm(array $form, FormStateInterface $form_state)
    {
        $form['text'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Text'),
        '#default_value' => $this->configuration['text'],
        '#required' => TRUE,
        ];
        return $form;
    }

    /**
     * {@inheritDoc}
     */
    public function isInline(): bool
    {
        return FALSE;
    }

}
