## Key AWS

Key AWS is an extension to the Key module.

This module provides a new key provider for supporting authentication against
the AWS. New key provider allows you to specify your path to the AWS
credentials file. The key provider and included service, will help parse and
also provide easy access to access keys.

### Requirements

Requires the Key module.

### Install

Install key_aws using a standard method for installing a contributed Drupal
module, either by downloading the package or using composer with

```bash
composer require drupal/key_aws
drush en key_aws
```

### Usage

#### AWS Credentials

* Start off by going to the "Manage Keys" page:/admin/config/system/keys
* Add new key.
* Specify internal name to easily identify key.
* For key type, select "AWS".
* For key provider, select "AWS Credentials".
* Specify your path to your AWS credentials file. See more information about credentials file: 
https://docs.aws.amazon.com/cli/latest/userguide/cli-configure-files.html
* Save key.

#### AWS S3 Configuration

Requires submodule key_aws_s3 to be enabled.

* Start off by going to the "Manage Keys" page:/admin/config/system/keys
* Add new key.
* Specify internal name to easily identify key.
* For key type, select "AWS S3".
* For key provider, select "AWS Configuration".
* Specify access and secret keys.
* Save key.

### Maintainers

* George Anderson (geoanders) - https://www.drupal.org/u/geoanders
