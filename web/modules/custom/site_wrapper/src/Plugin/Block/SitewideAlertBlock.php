<?php

declare(strict_types=1);

namespace Drupal\site_wrapper\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Defines a block to show the sitewide alert.
 *
 * @Block(
 *   id = "site_wrapper_sitewide_alert",
 *   admin_label = "Site Wrapper: Sitewide Alert",
 *   category = "Custom",
 * )
 */
final class SitewideAlertBlock extends BlockBase {

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
