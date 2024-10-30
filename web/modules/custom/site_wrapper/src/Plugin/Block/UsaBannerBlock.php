<?php

declare(strict_types=1);

namespace Drupal\site_wrapper\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Defines a block to show the USA Banner.
 *
 * @Block(
 *   id = "site_wrapper_usa_banner",
 *   admin_label = "Site Wrapper: USA Banner",
 *   category = "Custom",
 * )
 */
final class UsaBannerBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    return [
      'content' => [
        '#markup' => 'This text is not used.',
      ],
    ];
  }

}
