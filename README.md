# Calendly API client for PHP

Calendly API client for PHP

## Installation

Calendly API client for PHP can be installed with [Composer](https://getcomposer.org/). Run this command:

```sh
composer require lee-to/php-calendly
```

### Usage.

[Documentation](https://developer.calendly.com)

[Api token](https://calendly.com/integrations)

```php
use CalendlyApi\CalendlyApi;
use CalendlyApi\HttpAdapters\CurlHttpClient;
```

### Init.

```php

$calendlyApi = new CalendlyApi($token, new CurlHttpClient);
```


### Hooks
#### List all

``` php
$calendlyApi->hook()->all()
```

#### Get one

``` php
$calendlyApi->hook()->get($id)
```

#### Create

``` php
$calendlyApi->hook()->create(["url" => "https://name.com", "events" => ["invitee.created"]])
```

#### Delete

``` php
$calendlyApi->hook()->delete($id)
```

### User
#### About

``` php
$calendlyApi->user()->me()
```

#### User Event Types

``` php
$calendlyApi->user()->event_types()
```


## Tests

1. [Composer](https://getcomposer.org/) is a prerequisite for running the tests. Install composer globally, then run `composer install` to install required files.
2. Get personal token, then create `tests/CalendlyApiTestCredentials.php` from `tests/CalendlyApiTestCredentials.php.dist` and edit it to add your credentials.
3. The tests can be executed by running this command from the root directory:

```bash
$ ./vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Danil Shutsky](https://github.com/lee-to)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Security

If you have found a security issue, please contact the maintainers directly at [leetodev@ya.ru](mailto:leetodev@ya.ru).