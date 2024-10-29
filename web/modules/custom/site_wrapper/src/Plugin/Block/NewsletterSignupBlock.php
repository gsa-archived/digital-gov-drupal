<?php

declare(strict_types=1);

namespace Drupal\site_wrapper\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Defines a block to show the newsletter signup.
 *
 * @Block(
 *   id = "site_wrapper_newsletter_signup",
 *   admin_label = "Site Wrapper: Newsletter Signup",
 *   category = "Custom",
 * )
 */
final class NewsletterSignupBlock extends BlockBase {

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
