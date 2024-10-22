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
 *   id = "ec_shortcodes_do_dont_table",
 *   label = @Translation("Do/Don't Table"),
 *   description = @Translation("Renders a Do/Dont Table."),
 * )
 */
class ECShortcodesDoDontTable extends EmbeddedContentPluginBase implements EmbeddedContentInterface
{

    use StringTranslationTrait;

    /**
     * {@inheritdoc}
     */
    public function defaultConfiguration()
    {
        return [
        'heading' => NULL,
        'text' => NULL,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function build(): array
    {
        return [
        '#theme' => 'ec_shortcodes_do_dont_table',
        '#heading' => $this->configuration['text'],
        '#text' => $this->configuration['text'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function buildConfigurationForm(array $form, FormStateInterface $form_state)
    {
        $form['heading'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Heading'),
        '#default_value' => $this->configuration['text'],
        '#required' => TRUE,
        ];
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
