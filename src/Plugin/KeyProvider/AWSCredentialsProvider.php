<?php

namespace Drupal\key_aws\Plugin\KeyProvider;

use Drupal\Core\Form\FormStateInterface;
use Drupal\key\KeyInterface;
use Drupal\key\Plugin\KeyProvider\FileKeyProvider;

/**
 * Adds a AWS credentials file provider.
 *
 * @KeyProvider(
 *   id = "aws_file",
 *   label = @Translation("AWS Credentials"),
 *   description = @Translation("The AWS credentials file provider allows to be stored in a file, preferably outside of the web root."),
 *   storage_method = "file",
 *   key_value = {
 *     "accepted" = FALSE,
 *     "required" = FALSE
 *   }
 * )
 */
class AWSCredentialsProvider extends FileKeyProvider {

  /**
   * {@inheritdoc}
   */
  public function validateConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::validateConfigurationForm($form, $form_state);

    $key_provider_settings = $form_state->getValues();
    $file = $key_provider_settings['file_location'];

    // Make sure required keys are set.
    if ($values = parse_ini_file($file)) {
      // Check for access key.
      if (empty($values['aws_access_key_id'])) {
        $form_state->setErrorByName('file_location', $this->t('The credentials file is missing the following key: @key.', ['@key' => 'aws_access_key_id']));
        return;
      }

      // Check for secret key.
      if (empty($values['aws_secret_access_key'])) {
        $form_state->setErrorByName('file_location', $this->t('The credentials file is missing the following key: @key.', ['@key' => 'aws_secret_access_key']));
        return;
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getKeyValue(KeyInterface $key) {
    $file = $this->configuration['file_location'];

    // Make sure the file exists and is readable.
    if (!is_file($file) || !is_readable($file)) {
      return NULL;
    }

    return parse_ini_file($file);
  }

}
