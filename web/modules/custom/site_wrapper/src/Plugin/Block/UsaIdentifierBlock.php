<?php

declare(strict_types=1);

namespace Drupal\site_wrapper\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Defines a block to show the USA Identifier.
 *
 * @Block(
 *   id = "site_wrapper_usa_identifier",
 *   admin_label = "Site Wrapper: USA Identifier",
 *   category = "Custom",
 * )
 */
final class UsaIdentifierBlock extends BlockBase {

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
