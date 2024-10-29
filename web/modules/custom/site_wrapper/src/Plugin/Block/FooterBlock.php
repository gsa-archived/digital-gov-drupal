<?php

declare(strict_types=1);

namespace Drupal\site_wrapper\Plugin\Block;

use Drupal\Core\Block\Attribute\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\StringTranslation\TranslatableMarkup;

#[Block(
  id: "site_wrapper_footer",
  admin_label: new TranslatableMarkup("Site Wrapper: Footer"),
  category: new TranslatableMarkup("Custom"),
)]
final class FooterBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    return ['content' => [
      '#markup' => 'This text is not used.']
    ];
  }

}
