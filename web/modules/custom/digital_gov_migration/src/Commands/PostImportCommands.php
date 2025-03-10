<?php

namespace Drupal\digital_gov_migration\Commands;

use Drupal\Core\Entity\EntityFieldManagerInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drush\Commands\DrushCommands;
use Symfony\Component\Console\Helper\ProgressBar;
use Drupal\convert_text\ConvertText;
/**
 * A Drush commandfile for tasks to run after all content is migrated
 */
final class PostImportCommands extends DrushCommands {

  // Formatted text fields we might want to process
  const HTML_FIELDS = [
    'text_with_summary',
    'text_long',
  ];

  const HTML_FORMATS = [
    'html',
    'html_embedded_content',
    'multiline_html_limited',
    'multiline_inline_html',
    'single_inline_html',
  ];
  public function __construct(
    private EntityTypeManagerInterface $entityTypeManager,
    private EntityFieldManagerInterface $fieldManager,
  ) {
    parent::__construct();
  }

  /**
   * Update HTML with references to internal content
   *
   * @command digitalgov:update-nodes
   * @option bundles Optional comma-separated list of bundles to update
   */
  public function updateNodes(array $options = ['bundles' => []]): void {
    $this->output()->writeln('<info>Starting HTML update.</info>');

    if ($options['bundles'][0]) {
      $options['bundles'] = explode(',', trim($options['bundles'][0]));
    }

    $bundles = $this->getContentTypesAndFields($options['bundles']);

    foreach ($bundles as $bundle => $fields) {
      $this->output()->writeln("\n" .'<info>Updating ' . $bundle . ' nodes.</info>');
      $this->updateBundle($bundle, $fields);
    }

    $this->output()->writeln('');
    $this->output()->writeln('<info>Done.</info>');
  }

  private function updateBundle(string $bundle, array $fields): void {
    $nodes = $this->entityTypeManager
      ->getStorage('node')
      ->loadByProperties(['type' => $bundle]);

    $max = count($nodes);

    $progressBar = new ProgressBar($this->output, $max);
    $progressBar->start();

    foreach ($nodes as $node) {
      $changed = FALSE;
      foreach ($fields as $fieldName => $fieldConfig) {
        foreach ($node->get($fieldName) as &$item) {
          // Need the actual format used by this field
          $original = $item->get('value')->getValue();
          try {
            switch ($item->get('format')->getValue()) {
              case 'html_no_breaks':
                $item->set('value', ConvertText::htmlNoBreaksText($original));
                $changed = $changed || TRUE;

                break;
              case 'html':
                $item->set('value', ConvertText::htmlTextAfterMigrate($original));
                $changed = $changed || TRUE;
                break;
            }
          } catch (\Exception $exception) {
            $this->output()->writeln('');
            $this->output()->writeln('<error>Failed to update node ' . $node->id() . '</error>');
            trigger_error($exception->getMessage(), E_USER_WARNING);
            $changed = FALSE;
          }
        }
      }

      if ($changed) {
        $node->setSyncing(TRUE); // don't change modified dates
        $node->save();
      }

      $progressBar->advance();
    }

    $progressBar->finish();
  }

  private function getContentTypesAndFields(array $bundles = []): array {
    $entityTypeManager = \Drupal::service('entity_type.manager');

    $types = [];
    $contentTypes = $entityTypeManager->getStorage('node_type')->loadMultiple();
    foreach ($contentTypes as $contentType) {
      if ($bundles && !in_array($contentType->id(), $bundles)) {
        continue;
      }

      $fields  = $this->fieldManager->getFieldDefinitions('node', $contentType->id());
      // Keep HTML fields that we need to update
      $fields = array_filter($fields, function ($field) {
        if (!in_array($field->getType(), self::HTML_FIELDS)) {
          return FALSE;
        }

        $allowed = $field->getSetting('allowed_formats');
        if (!array_intersect($allowed, self::HTML_FORMATS)) {
          return FALSE;
        }

        return TRUE;
      });

      if ($fields) {
        $types[$contentType->id()] = $fields;
      }
    }

    if (empty($types)) {
      throw new \InvalidArgumentException('No content types found.');
    }
    return $types;
  }

}
