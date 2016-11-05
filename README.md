# Marketo PHP API client

[![Version](https://img.shields.io/packagist/v/bickart/marketo-php.svg?style=flat-square)](https://packagist.org/packages/bickart/marketo-php)
 [![Total Downloads](https://img.shields.io/packagist/dt/bickart/marketo-php.svg?style=flat-square)](https://packagist.org/packages/bickart/marketo-php)
 [![License](https://img.shields.io/packagist/l/bickart/marketo-php.svg?style=flat-square)](https://packagist.org/packages/bickart/marketo-php)
 [![CodeClimate Test Coverage](https://img.shields.io/codeclimate/coverage/github/bickart/marketo-php.svg?style=flat-square)](https://codeclimate.com/github/bickart/marketo-php/coverage)
 [![Build Status](https://img.shields.io/travis/bickart/marketo-php.svg?style=flat-square)](https://travis-ci.org/bickart/marketo-php)

Marketo API client: A PHP REST client 

## ANNOUNCEMENT!

## Setup

**Composer:**

```bash
composer require "bickart/marketo-php:1.0"
```

## Quickstart

### Examples Using Factory

All following examples assume this step.

```php
$marketo = Amaiza\Marketo\Factory::create('REST API Endpoint', 'REST CLIENT ID', 'REST CLIENT SECRET');

// OR instantiate by passing a configuration array.
// The only required value is the 'key'

$marketo = new Amaiza\Marketo\Factory([
  'url'      => 'REST API Endpoint',
  'client_id'    => 'REST CLIENT ID', 
  'client_secret' => 'REST CLIENT SECRET'
]);
```
*Note:* The Client class checks for a `MARKETO_ENDPOINT`, `MARKETO_CLIENT_ID`, and `MARKETO_CLIENT_SECRET` environment variable if you don't include an tokens during instantiation.

#### Get a single lead:

```php
$lead = $marketo->leads()->getById(1);

echo $lead->data->result[0]->email;
```

#### Paginate through all leads:

```php
// Get an array of 10 contacts
// getting only the firstname and lastname properties
// and set the offset to 123456
$response = $marketo->leads()->all([
    'count'     => 10,
    'property'  => ['firstname', 'lastname'],
    'vidOffset' => 123456,
]);
```

Working with the data is easy!

```php
foreach ($response->contacts as $contact) {
    echo sprintf(
        "Contact name is %s %s." . PHP_EOL,
        $contact->properties->firstname->value,
        $contact->properties->lastname->value
    );
}

// Info for pagination
echo $response->{'has-more'};
echo $response->{'vid-offset'};
```

or if you prefer to use array access?

```php
foreach ($response['contacts'] as $contact) {
    echo sprintf(
        "Contact name is %s %s." . PHP_EOL,
        $contact['properties']['firstname']['value'],
        $contact['properties']['lastname']['value']
    );
}

// Info for pagination
echo $response['has-more'];
echo $response['vid-offset'];
```

Now with response methods implementing [PSR-7 ResponseInterface](https://github.com/php-fig/http-message/tree/master/src)

```php
$response->getStatusCode()   // 200;
$response->getReasonPhrase() // 'OK';
// etc...
```

### Example Without Factory

```php
<?php

require 'vendor/autoload.php';

use Amaiza\Marketo\Http\Client;
use Amaiza\Marketo\Resources\Contacts;

$client = new Client(['key' => 'demo']);

$contacts = new Contacts($client);

$response = $contacts->all();

foreach ($response->contacts as $contact) {
    //
}
```

## Status

If you see something not planned, that you want, make an [issue](https://github.com/fungku/hubspot-php/issues) and there's a good chance I will add it.

- [ ] Companies :new:
- [ ] Leads :new:
- [ ] Opportunities :new:
- [ ] OpportunityRoles :new:
- [ ] SalesPersons :new:
- [x] Stats
