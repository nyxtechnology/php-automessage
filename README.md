# PHP Automessage

PHP library to send events to NYX Automessage.


### Installation

```php
composer require nyx-tc/php-automessage
```
### Usage
```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Nyx\Automessage\Automessage;

$metadata = new \stdClass();
$metadata->to   = "john-wick@wickmail.com";
$metadata->list = "killers-london";
$metadata->name = "John Wick";

$data = [
    'event' => 'subscribeList',
    'metadata' => $metadata
];

$jsonData = json_encode($data);

Automessage::$endpoint = 'automessage.nyx.tc/api/webhook';
print_r(Automessage::sendEvent($jsonData));
```
