<?php

declare(strict_types = 1);

namespace Drupal\digital_gov_migration\Plugin\migrate_plus\data_parser;

use Drupal\migrate_plus\Plugin\migrate_plus\data_parser\Json;

/**
 * Obtain JSON data for migration.
 *
 * Preparea the topics data so that we can import featured resources
 * as paragraph entities with these fields:
 *
 *  - parent_uid: uid of the parent node
 *  - url: link to the resource, required
 *  - title: title, optional (internal ones in hugo don't have this)
 *  - summary: summary text, optional
 *
 * @DataParser(
 *   id = "json_topics",
 *   title = @Translation("JSON Fetcher and munger for Digital.gov for Topics")
 * )
 */
class JSON_topics extends Json {

  protected function getSourceData(string $url, int|string $item_selector = '')
  {
    // Use cached source data if this is the first request or URL is same as the
    // last time we made the request.
    if ($this->currentUrl != $url || !$this->sourceData) {
      $response = $this->getDataFetcherPlugin()->getResponseContent($url);

      // Convert objects to associative arrays.
      $this->sourceData = json_decode($response, TRUE);

      foreach ($this->sourceData['items'] as &$item) {
        if (isset($item['field_featured_resources'])) {
          foreach ($item['field_featured_resources'] as &$resource) {
            $resource['parent_uid'] = $item['uid'];

            // UID with unchanged inputs to match in migrations
            $resource['uid'] = hash('sha256', $item['uid'] . '::' . $resource['field_featured_resource_link']);
          }
        } else {
          $item['field_featured_resources'] = [];
        }
      }

      // If json_decode() has returned NULL, it might be that the data isn't
      // valid utf8 - see http://php.net/manual/en/function.json-decode.php#86997.
      if (!$this->sourceData) {
        $utf8response = mb_convert_encoding($response, 'UTF-8');
        $this->sourceData = json_decode($utf8response, TRUE);
      }
      $this->currentUrl = $url;
    }

    // Backwards-compatibility for depth selection.
    if (is_numeric($this->itemSelector)) {
      return $this->selectByDepth($this->sourceData, (int) $item_selector);
    }

    // If the item_selector is an empty string, return all.
    if ($item_selector === '') {
      return $this->sourceData;
    }

    // Otherwise, we're using xpath-like selectors.
    $selectors = explode('/', trim($item_selector, '/'));
    $return = $this->sourceData;
    foreach ($selectors as $selector) {
      // If the item_selector is missing, return an empty array.
      if (!isset($return[$selector])) {
        return [];
      }
      $return = $return[$selector];
    }
    return $return;
  }

}
