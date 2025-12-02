## Key AWS S3

Key AWS S3 is an extension to the Key module.

This module provides a new key type for supporting authentication against
the Amazon S3 service. This key will capture both the access and secret keys
required for accessing the S3 cloud storage.

### Requirements

Requires the Key module.

### Install

Install key_aws_s3 using a standard method for installing a contributed Drupal
module, either by downloading the package or using composer with

```bash
composer require drupal/key_aws_s3
drush en key_aws_s3
```

### Usage

Follow the [Key](https://drupal.org/project/key) documentation for getting and
using keys by adding a `key_select` element to your form in order to select your key.

You can apply a filter to select only aws_s3 keys:

```php
$form['aws_s3_auth'] = [
  '#type' => 'key_select',
  '#title' => $this->t('AWS S3 Auth'),
  '#key_filters' => ['type' => 'amazon_s3_key'],
];
```

### Maintainers

* George Anderson (geoanders) - https://www.drupal.org/u/geoanders
