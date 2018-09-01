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

echo StringHelper::transliterate('очень простой пример', 'Russian-Latin/BGN');     // Prints transliterated 'ochen prostoj primer'
echo StringHelper::standardize('очень простой  Пример', 'Russian-Latin/BGN');      // Prints standardizated 'ochen_prostoj_primer', '_' is default words separator
echo StringHelper::standardize('очень простой  Пример', 'Russian-Latin/BGN', '-'); // Prints 'ochen-prostoj-primer', use '-' for slugify string

var_dump(StringHelper::toArray('1,2,3,')); // Prints Array ['1', '2', '3'], ',' is default separator

echo StringHelper::snakecaseToCamelcase('snake_case');       // Prints 'SnakeCase'
echo StringHelper::snakecaseToCamelcase('snake_case', true); // Prints 'snakeCase'
echo StringHelper::camelcaseToSnakecase('CamelCase');        // Prints 'camel_case'
```

### UrlHelper

```php
use Nameless\Utilities\UrlHelper;

echo UrlHelper::toPath('/path/to/url', '/base'); // Prints '/base/path/to/url'
```

### BcMathHelper

Passing values of type float to a BCMath function which expects a string as operand may not have the desired effect 
due to the way PHP converts float values to string, namely that the string may be in exponential notation (what is not 
supported by BCMath), and that the decimal separator is locale depended (while BCMath always expects a decimal point). 

```php
<?php

$num1 = 0;         // (string) 0 => '0'
$num2 = -0.000005; // (string) -0.000005 => '-5.05E-6'

echo bcadd($num1, $num2, 6); // => '0.000000'

setlocale(LC_NUMERIC, 'de_DE'); // uses a decimal comma
$num2 = 1.2;                    // (string) 1.2 => '1,2'

echo bcsub($num1, $num2, 1);    // => '0.0'

?>
```

BcMathHelper solve problem with floats to strings converting and "," as decimal separator for BcMath functions:

```php
use Nameless\Utilities\BcMathHelper;

var_dump(BcMathHelper::add('0.000005', '0.000005', 5));  // (float)0.00001
var_dump(BcMathHelper::add('0,000005', '0,000005', 5));  // (float)0.00001
var_dump(BcMathHelper::add(0.000005, 0.000005, 5));  // (float)0.00001
var_dump(BcMathHelper::add('5.0E-6', '5.0E-7', 5));  // (float)0.00001

var_dump(BcMathHelper::sub(0.000005, 0.000001, 5));  // (float)0.000004

var_dump(BcMathHelper::mul(0.000005, 0.000002, 11));  // (float)0.00000000001

var_dump(BcMathHelper::div(0.000005, 0.000002, 2));  // (float)2.50

var_dump(BcMathHelper::comp(0.000005, 0.000002, 6));  // (int)1
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
