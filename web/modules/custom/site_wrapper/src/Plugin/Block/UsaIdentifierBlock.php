<?php

declare(strict_types=1);

namespace Drupal\site_wrapper\Plugin\Block;

use Drupal\Core\Block\Attribute\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\StringTranslation\TranslatableMarkup;

#[Block(
  id: "site_wrapper_usa_identifier",
  admin_label: new TranslatableMarkup("Site Wrapper: USA Identifier"),
  category: new TranslatableMarkup("Custom"),
)]
final class UsaIdentifierBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    return ['content' => [
      '#markup' => 'This text is not used.']
    ];
  }

}
