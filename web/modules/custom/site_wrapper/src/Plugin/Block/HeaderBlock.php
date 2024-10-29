<?php

declare(strict_types=1);

namespace Drupal\site_wrapper\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Defines a block to show the Header.
 *
 * @Block(
 *   id = "site_wrapper_header",
 *   admin_label = "Site Wrapper: Header",
 *   category = "Custom",
 * )
 */
final class HeaderBlock extends BlockBase {

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
