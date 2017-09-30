[![PHP Censor](http://ci.php-censor.info/build-status/image/4?branch=master&label=PHPCensor&style=flat-square)](http://ci.php-censor.info/build-status/view/4?branch=master)
[![Travis CI](https://img.shields.io/travis/corpsee/nameless-utilities/master.svg?label=TravisCI&style=flat-square)](https://travis-ci.org/corpsee/nameless-utilities?branch=master)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/b0f43135-8362-4601-8a11-aff023fe3815.svg?label=Insight&style=flat-square)](https://insight.sensiolabs.com/projects/b0f43135-8362-4601-8a11-aff023fe3815)
[![Codecov](https://img.shields.io/codecov/c/github/corpsee/nameless-utilities.svg?label=Codecov&style=flat-square)](https://codecov.io/gh/corpsee/nameless-utilities)
[![Latest Version](https://img.shields.io/packagist/v/corpsee/nameless-utilities.svg?label=Version&style=flat-square)](https://packagist.org/packages/corpsee/nameless-utilities)
[![Total downloads](https://img.shields.io/packagist/dt/corpsee/nameless-utilities.svg?label=Downloads&style=flat-square)](https://packagist.org/packages/corpsee/nameless-utilities)
[![License](https://img.shields.io/packagist/l/corpsee/nameless-utilities.svg?label=License&style=flat-square)](https://packagist.org/packages/corpsee/nameless-utilities)

Nameless utilities
==================

PHP Utilities compliant with PSR-1, PSR-2, PSR-4 and Composer.

Installation
------------

You can install Nameless utilities by composer. Add following code to "require" section of the `composer.json`:

```json
"require": {
    "corpsee/nameless-utilities": "<version>"
}
```

And install dependencies using the Composer:

```bash
cd path/to/your-project
composer install
```

Usage
-----

### ArrayHelper

```php
use Nameless\Utilities\ArrayHelper;

echo ArrayHelper::toString([1, 2, 3]); // Prints '1, 2, 3', ', ' is default separator
echo ArrayHelper::toString([1, 2, 3], ':'); // Prints '1:2:3'

$array = [
    'one'   => 1,
    'two'   => 2,
    'three' => 3,
];
echo ArrayHelper::get($array, 'four', 4); // Prints '4' (4)
```

### DateTimeHelper

```php
use Nameless\Utilities\DateTimeHelper;

echo DateTimeHelper::humanize(121.001); // Prints '2 minute 1 second 1 millisecond'
```

Usage with localization/alternative labels:

```php
use Nameless\Utilities\DateTimeHelper;

$localization = [
    ['мкс', 'мкс'],
    ['мс', 'мс'],
    ['с', 'с'],
    ['мин', 'мин'],
    ['ч', 'ч'],
    ['д', 'д'],
    ['мес', 'мес'],
    ['г', 'г'],
];

echo DateTimeHelper::humanize(121, $localization); // Prints '2 мин 1 с'
```

### FileSizeHelper

```php
use Nameless\Utilities\FileSizeHelper;

echo FileSizeHelper::humanize(1000000000); // Prints '953.67MB'
echo FileSizeHelper::unhumanize('954MB');  // Prints '1000341504' (bytes)
```

### PathHelper

```php
use Nameless\Utilities\PathHelper;

echo PathHelper::toURL('/base/path/to/url', '/base'); // Prints '/path/to/url'
```

### StringHelper

```php
use Nameless\Utilities\StringHelper;

var_dump(StringHelper::startWith('example', 'exa'));  // Prints true
var_dump(StringHelper::endWith('example', 'mplee'));  // Prints true
var_dump(StringHelper::contains('example', 'xampl')); // Prints true

echo StringHelper::cut('example', 6);             // Prints 'exampl...', '...' is default suffix
echo StringHelper::cutWords('simple example', 1); // Prints 'example...', '...' is default suffix

echo StringHelper::transliterate('очень простой пример');     // Prints transliterated 'ochen prostoj primer'
echo StringHelper::standardize('очень простой  Пример');      // Prints standardizated 'ochen_prostoj_primer', '_' is default words separator
echo StringHelper::standardize('очень простой  Пример', '-'); // Prints 'ochen-prostoj-primer', use '-' for slugify string

var_dump(StringHelper::toArray('1,2,3,')); // Prints Array ['1', '2', '3'], ',' is default separator
```

### UrlHelper

```php
use Nameless\Utilities\UrlHelper;

echo UrlHelper::toPath('/path/to/url', '/base'); // Prints '/base/path/to/url'
```

Tests
-----

You can run the unit tests with the following commands:

```bash
cd path/to/nameless-utilities
./vendor/bin/phpunit
```

License
-------

The Nameless utilities is open source software licensed under the GPL-3.0 license.
