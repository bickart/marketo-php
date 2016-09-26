# Marketo PHP API client

[![Version](https://img.shields.io/packagist/v/bickart/marketo-php.svg?style=flat-square)](https://packagist.org/packages/bickart/marketo-php)
 [![Total Downloads](https://img.shields.io/packagist/dt/bickart/marketo-php.svg?style=flat-square)](https://packagist.org/packages/bickart/marketo-php)
 [![License](https://img.shields.io/packagist/l/bickart/marketo-php.svg?style=flat-square)](https://packagist.org/packages/bickart/marketo-php)
 [![CodeClimate Test Coverage](https://img.shields.io/codeclimate/coverage/github/bickart/marketo-php.svg?style=flat-square)](https://codeclimate.com/github/bickart/marketo-php/coverage)
 [![Build Status](https://img.shields.io/travis/bickart/marketo-php.svg?style=flat-square)](https://travis-ci.org/bickart/marketo-php)

Marketo API client. The sequel to my [perfectly functional wrapper](https://github.com/fungku/hubspot) of HubSpot/haPihP.
client. However, this is a complete re-write and includes some of the new COS/v2 endpoints.

## ANNOUNCEMENT!


## Setup

**Composer:**

```bash
composer require "bickart/marketo-php:1.0.*@dev"
```

## Quickstart

### Examples Using Factory

All following examples assume this step.

```php
$hubspot = Amaiza\Marketo\Factory::create('api-key');

// OR instantiate by passing a configuration array.
// The only required value is the 'key'

$hubspot = new Amaiza\Marketo\Factory([
  'key'      => 'demo',
  'oauth'    => false, // default
  'base_url' => 'https://api.hubapi.com' // default
]);
```
*Note:* The Client class checks for a `HUBSPOT_SECRET` environment variable if you don't include an api key or oauth token during instantiation.

#### Get a single contact:

```php
$contact = $hubspot->contacts()->getByEmail("test@hubspot.com");

echo $contact->properties->email->value;
```

#### Paginate through all contacts:

```php
// Get an array of 10 contacts
// getting only the firstname and lastname properties
// and set the offset to 123456
$response = $hubspot->contacts()->all([
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
