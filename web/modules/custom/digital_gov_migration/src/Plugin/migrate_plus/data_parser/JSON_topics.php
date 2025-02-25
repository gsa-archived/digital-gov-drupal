<?php

declare(strict_types = 1);

namespace Drupal\digital_gov_migration\Plugin\migrate_plus\data_parser;

/**
 * Obtain JSON data for migration.
 *
 * Prepares the topics data so that we can import featured resources and links
 * as paragraph entities.
 *
 * @DataParser(
 *   id = "json_topics",
 *   title = @Translation("JSON Fetcher and munger for Digital.gov for Topics")
 * )
 */
class JSON_topics extends JSON_tamperer {
  protected function alterFeed(&$feed): void
  {
    foreach ($this->sourceData['items'] as &$item) {
      if (isset($item['field_featured_resources'])) {
        foreach ($item['field_featured_resources'] as &$resource) {
          $resource['parent_uid'] = $item['uid'];

          // UID with unchanged inputs to match in migrations
          $resource['resource_uid'] = hash('sha256', $item['uid'] . '::' . $resource['field_featured_resource_link']);
        }
      }
      else {
        $item['field_featured_resources'] = [];
      }

      if (isset($item['field_featured_links'])) {
        // We need this field to point to the uid set by the
        // JSON_topic_featured_links migration to match this node
        // with the paragraph for featured links.
        $item['field_featured_links'] = $item['uid'];
      }
      else {
        $item['field_featured_links'] = [];
      }
    }
  }
}
