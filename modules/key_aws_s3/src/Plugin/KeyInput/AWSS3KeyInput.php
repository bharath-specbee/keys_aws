<?php

namespace Drupal\key_aws_s3\Plugin\KeyInput;

use Drupal\Core\Form\FormStateInterface;
use Drupal\key\Plugin\KeyInputBase;

/**
 * Defines a key input for AWS S3.
 *
 * @KeyInput(
 *   id = "aws_s3",
 *   label = @Translation("AWS S3 credentials"),
 *   description = @Translation("A collection of fields to store Amazon S3 credentials.")
 * )
 */
class AWSS3KeyInput extends KeyInputBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration(): array {
    return [
      'aws_access_key_id' => '',
      'aws_secret_access_key' => '',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state): array {
    $config = $this->getConfiguration();
    $key = $form_state->getFormObject()->getEntity();

    $definition = $key->getKeyType()->getPluginDefinition();
    $fields = $definition['multivalue']['fields'];
    foreach ($fields as $id => $field) {
      $form[$id] = [
        '#type' => 'textfield',
        '#title' => $field['label'],
        '#required' => $field['required'],
        '#maxlength' => 4096,
        '#default_value' => $config[$id],
        '#attributes' => ['autocomplete' => 'off'],
      ];
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function processSubmittedKeyValue(FormStateInterface $form_state): array {
    $values = $form_state->getValues();

    return [
      'submitted' => $values,
      'processed_submitted' => $values,
    ];
  }

}
