<?php

declare(strict_types=1);

namespace Drupal\site_wrapper\Plugin\Block;

use Drupal\Core\Block\Attribute\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\StringTranslation\TranslatableMarkup;

#[Block(
  id: "site_wrapper_sitewide_alert",
  admin_label: new TranslatableMarkup("Site Wrapper: Sitewide Alert"),
  category: new TranslatableMarkup("Custom"),
)]
final class SitewideAlertBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    return ['content' => [
      '#markup' => 'This text is not used.']
    ];
  }

}
