<?php

declare(strict_types=1);

namespace Drupal\site_wrapper\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Defines a block to show the notice bar.
 *
 * @Block(
 *   id = "site_wrapper_notice_bar",
 *   admin_label = "Site Wrapper: Notice Bar",
 *   category = "Custom",
 * )
 */
final class NoticeBarBlock extends BlockBase {

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
