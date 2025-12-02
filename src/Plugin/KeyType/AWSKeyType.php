<?php

namespace Drupal\key_aws\Plugin\KeyType;

use Drupal\Core\Form\FormStateInterface;
use Drupal\key\Plugin\KeyTypeBase;

/**
 * Defines a generic key type for AWS authentication.
 *
 * @KeyType(
 *   id = "aws",
 *   label = @Translation("AWS"),
 *   description = @Translation("AWS key type to be used with other AWS key providers."),
 *   group = "aws",
 *   key_value = {
 *     "plugin" = "none"
 *   }
 * )
 */
class AWSKeyType extends KeyTypeBase {

  /**
   * {@inheritdoc}
   */
  public static function generateKeyValue(array $configuration): ?string {
    return NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function validateKeyValue(array $form, FormStateInterface $form_state, $key_value) {
    // Validation of the key value is optional.
  }

}
