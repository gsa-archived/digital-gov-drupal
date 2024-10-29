<?php

declare(strict_types=1);

namespace Drupal\site_wrapper\Plugin\Block;

use Drupal\Core\Block\Attribute\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\StringTranslation\TranslatableMarkup;

#[Block(
  id: "site_wrapper_notice_bar",
  admin_label: new TranslatableMarkup("Site Wrapper: Notice Bar"),
  category: new TranslatableMarkup("Custom"),
)]
final class NoticeBarBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    return ['content' => [
      '#markup' => 'This text is not used.']
    ];
  }

}
