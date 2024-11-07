<?php

declare(strict_types=1);

namespace Drupal\site_wrapper\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Defines a block to show the footer.
 *
 * @Block(
 *   id = "site_wrapper_footer",
 *   admin_label = "Site Wrapper: Footer",
 *   category = "Custom",
 * )
 */
final class FooterBlock extends BlockBase {

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
