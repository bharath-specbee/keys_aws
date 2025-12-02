<?php

namespace Drupal\key_aws_s3\Plugin\KeyType;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Form\FormStateInterface;
use Drupal\key\Plugin\KeyType\AuthenticationMultivalueKeyType;

/**
 * Defines a key for Amazon S3 credentials.
 *
 * @KeyType(
 *   id = "amazon_s3_key",
 *   label = @Translation("AWS S3"),
 *   description = @Translation("Amazon S3 credentials"),
 *   group = "aws",
 *   key_value = {
 *     "plugin" = "aws_s3"
 *   },
 *   multivalue = {
 *     "enabled" = true,
 *     "fields" = {
 *       "aws_access_key_id" = {
 *         "label" = @Translation("AWS Access Key"),
 *         "required" = true,
 *       },
 *       "aws_secret_access_key" = {
 *         "label" = @Translation("AWS Secret Key"),
 *         "required" = true,
 *       },
 *     }
 *   }
 * )
 */
class AWSS3KeyType extends AuthenticationMultivalueKeyType {

  /**
   * {@inheritdoc}
   */
  public static function generateKeyValue(array $configuration) {
    return Json::encode($configuration);
  }

  /**
   * {@inheritdoc}
   */
  public function validateKeyValue(array $form, FormStateInterface $form_state, $key_value) {
    if (!is_array($key_value) || empty($key_value)) {
      return;
    }
    $input_fields = $form['settings']['input_section']['key_input_settings'];
    $definition = $this->getPluginDefinition();
    $fields = $definition['multivalue']['fields'];
    foreach ($fields as $id => $field) {
      if (!is_array($field)) {
        $field = ['label' => $field];
      }
      if (isset($field['required']) && $field['required'] === FALSE) {
        continue;
      }
      $error_element = $input_fields[$id] ?? $form;
      if (!isset($key_value[$id])) {
        $form_state->setError($error_element, $this->t('The key value is missing the field %field.', ['%field' => $id]));
      }
      elseif (empty($key_value[$id])) {
        $form_state->setError($error_element, $this->t('The key value field %field is empty.', ['%field' => $id]));
      }
    }
  }

}
