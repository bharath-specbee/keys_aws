<?php

namespace Drupal\key_aws;

use Drupal\key\KeyRepository;

/**
 * AWS Key Repository Service.
 */
class AWSKeyRepository {

  /**
   * The key repository object.
   *
   * @var \Drupal\key\KeyRepository
   */
  protected $keyRepository;

  /**
   * The loaded or current key.
   *
   * @var \Drupal\key\KeyInterface
   */
  private $key;

  /**
   * The AWS Key Repository Constructor.
   *
   * @param \Drupal\key\KeyRepository $keyRepository
   *   Key repository object.
   */
  public function __construct(KeyRepository $keyRepository) {
    $this->keyRepository = $keyRepository;
  }

  /**
   * Set and load key by key name.
   *
   * @param string $key_name
   *   The name of the key.
   */
  public function setKey(string $key_name) {
    if ($key = $this->keyRepository->getKey($key_name)) {
      $this->key = $key;
    }
  }

  /**
   * Get credentials.
   *
   * @return array
   *   Returns credentials in array format.
   */
  public function getCredentials(): array {
    $credentials = [];
    if ($this->key) {
      if ($this->key->getKeyProvider()->getPluginId() == 'aws_file') {
        $credentials = $this->key->getKeyValue();
      }
      elseif ($this->key->getKeyProvider()->getPluginId() == 'aws_config') {
        $credentials = $this->key->getKeyValues();
      }
    }
    return $credentials ?? [];
  }

  /**
   * Get credentials configured for client.
   *
   * @return array
   *   Returns client credentials.
   */
  public function getClientCredentials(): array {
    if ($credentials = $this->getCredentials()) {
      return [
        'key' => $credentials['aws_access_key_id'],
        'secret' => $credentials['aws_secret_access_key'],
      ];
    }
    else {
      return [];
    }
  }

  /**
   * Get access key.
   *
   * @return mixed|null
   *   Returns the access key if found.
   */
  public function getAccessKey() {
    $accessKey = NULL;
    $credentials = $this->getCredentials();
    if (!empty($credentials['aws_access_key_id'])) {
      $accessKey = $credentials['aws_access_key_id'];
    }
    return $accessKey;
  }

  /**
   * Get secret key.
   *
   * @return mixed|null
   *   Returns the access key if found.
   */
  public function getSecretKey() {
    $secretKey = NULL;
    $credentials = $this->getCredentials();
    if (!empty($credentials['aws_secret_access_key'])) {
      $secretKey = $credentials['aws_secret_access_key'];
    }
    return $secretKey;
  }

}
