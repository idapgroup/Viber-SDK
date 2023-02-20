# Viber SDK

Viber SDK for working with GMS-worldwide Api.

## Documentation

The documentation for the GMS-worldwide Api can be found [here](https://www.gms-worldwide.com/developers).

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
composer require idapgroup/viber-sdk
```

or add

```json
{
  "require": {
      "idapgroup/viber-sdk": "^1.0.0"
  }
}
```

to the require section of your `composer.json` file.

## Quickstart

### Create an Api client

```php
<?php

require 'vendor/autoload.php';

use IdapGroup\ViberSdk\Config;
use IdapGroup\ViberSdk\Client;
use IdapGroup\ViberSdk\Api;
use IdapGroup\ViberSdk\Sms;
use IdapGroup\ViberSdk\Viber;
use IdapGroup\ViberSdk\Parameter;

$sms        = new Sms();
$viber      = new Viber();
$parameter  = new Parameter();
$config     = new Config();
$client     = new Client(['login' => 'Your login', 'password' => 'Your password']);

// Instantiate an Api client.
$api        = new Api($config, $client);
```

### Configuration

#### Viber message

```php
$viber->setTtl(60);                                                 // require
$viber->setIosExpirityText('Text for ios when message expires');    // require
$viber->setText('Text for viber');                                  // require
$viber->setImgUrl('https://path-to-img.com');
$viber->setCaption('Click me');
$viber->setAction('https://clicked.org');
```

#### Sms

```php
$sms->setText('Text for sms');                                      // require
$sms->setAlphaName('Alpha name');                                   // require
$sms->setTtl(60);                                                   // require
```

### Send a message

```php
$parameter->setPhoneNumber(380123456789);                           // require
$parameter->setIsPromotional(true);                                 // require
$parameter->setChannels(['viber', 'sms']);                          // require
$parameter->setChannelsOptions($sms, $viber);                       // require
$parameter->setExtraId('2j4h89932kjhs');
$parameter->setTag('Mailing list name');
$parameter->setCallbackUrl('https://send-dr-here.com');
$parameter->setStartTime('2022-12-12 10:10:10');
          
          
$response = $api->sendMessage($parameter);

print_r ($response);
```

### Get short detail report by message id

```php
$response = $api->getShortDrByMessageId('769417569');
```

### Get short detail report by extra id

```php
$response = $api->getShortDrByExtraId('2j4h89932kjhs');
```

### Get full detail report by message id

```php
$response = $api->getFullDrByMessageId('769417569');
```
### Get full detail report by extra id

```php
$response = $api->getFullDrByExtraId('2j4h89932kjhs');
```
