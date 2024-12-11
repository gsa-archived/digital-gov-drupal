<?php

namespace Drupal\dg_fields\Plugin\Filter;

use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\filter\Attribute\Filter;
use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;
use Drupal\filter\Plugin\FilterInterface;

/**
 * Provides a filter remove br & p tags.
 */
#[Filter(
  id: "filter_breaks",
  title: new TranslatableMarkup("Remove break and paragraph tags."),
  type: FilterInterface::TYPE_TRANSFORM_REVERSIBLE,
  weight: -10,
)]
class FilterBreaks extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode): FilterProcessResult {
    $text = str_replace(['<p>', '</p>', '<br>', '<br/>', '<br />'], ' ', $text);
    return new FilterProcessResult($text);
  }

}
