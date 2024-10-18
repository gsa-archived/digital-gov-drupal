<?php
namespace Drupal\ec_button\Plugin\EmbeddedContent;

use Drupal\embedded_content\EmbeddedContentInterface;
use Drupal\embedded_content\EmbeddedContentPluginBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;

// ! update for example
/**
 * Plugin iframes.
 *
 * @EmbeddedContent(
 *   id = "ec_placeholder",
 *   label = @Translation("Placeholder"),
 *   description = @Translation("Renders a placeholder for replacement."),
 * )
 */
class ECButton extends EmbeddedContentPluginBase implements EmbeddedContentInterface
{

    use StringTranslationTrait;

    /**
     * {@inheritdoc}
     */
    public function defaultConfiguration()
    {
        return [
        'url' => null,
        'text' => null,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function build(): array
    {
        return [
        '#theme' => 'ec_button',
        '#url' => $this->configuration['url'],
        '#text' => $this->configuration['text'],
        ];
    }

    public function buildConfigurationForm(array $form, FormStateInterface $form_state)
    {
        $form['url'] = [
        '#type' => 'url',
        '#title' => $this->t('Url'),
        '#default_value' => $this->configuration['url'],
        '#required' => true,
        ];
        $form['text'] = [
        '#type' => 'textfield',
        '#title' => $this->t('text'),
        '#default_value' => $this->configuration['text'],
        '#required' => true,
        ];
        return $form;
    }

    /**
     * {@inheritDoc}
     */
    public function isInline(): bool
    {
        return false;
    }

}
