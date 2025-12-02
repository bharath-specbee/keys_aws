<?php

namespace Drupal\key_aws\Plugin\KeyProvider;

use Drupal\key\Plugin\KeyProvider\ConfigKeyProvider;

/**
 * Adds a key provider that allows a key to be stored in configuration.
 *
 * @KeyProvider(
 *   id = "aws_config",
 *   label = @Translation("AWS Configuration"),
 *   description = @Translation("The AWS Configuration key provider stores the key in Drupal's configuration system."),
 *   storage_method = "config",
 *   key_value = {
 *     "accepted" = TRUE,
 *     "required" = FALSE
 *   }
 * )
 */
class AWSConfigKeyProvider extends ConfigKeyProvider {

}
