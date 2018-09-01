<?php

namespace Nameless\Utilities\Tests;

use Nameless\Utilities\StringHelper;

class StringHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testStartWith()
    {
        self::assertTrue(StringHelper::startWith('example', 'exa'));
        self::assertTrue(StringHelper::startWith('пример', 'пр'));
    }

    public function testEndWith()
    {
        self::assertTrue(StringHelper::endWith('example', 'ample'));
        self::assertTrue(StringHelper::endWith('пример', 'мер'));
    }

    public function testContains()
    {
        self::assertTrue(StringHelper::contains('example', 'xampl'));
        self::assertTrue(StringHelper::contains('пример', 'им'));

        self::assertFalse(StringHelper::contains('пример', 'рп'));
    }

    public function testCut()
    {
        self::assertEquals('exampl...', StringHelper::cut('example', 6));
        self::assertEquals('при...', StringHelper::cut('пример', 3));
        self::assertEquals('пример', StringHelper::cut('пример', 6));
        self::assertEquals('пример', StringHelper::cut('пример', 7));
    }

    public function testCutWords()
    {
        self::assertEquals('simple...', StringHelper::cutWords('simple example', 1));
        self::assertEquals('очень простой...', StringHelper::cutWords('очень простой пример', 2));
        self::assertEquals('очень простой', StringHelper::cutWords('очень простой', 3));
    }

    public function testTransliterate()
    {
        self::assertEquals(
            'ochen prostoj primer',
            StringHelper::transliterate('очень простой пример')
        );

        self::assertEquals(
            'velmi jednoduchy priklad',
            StringHelper::transliterate('velmi jednoduchý příklad')
        );
    }

    public function testStandardize()
    {
        self::assertEquals(
            'ochen-prostoj-primer',
            StringHelper::standardize('очень простой   Пример', '-')
        );

        self::assertEquals(
            'velmi_jednoduchy_priklad',
            StringHelper::standardize(' Velmi:;+ Jednoduchý___příklad  ')
        );
    }

    public function testToArray()
    {
        self::assertEquals(['1', '2', '3'], StringHelper::toArray('1,2,3,'));
        self::assertEquals(['one', 'two', 'tree'], StringHelper::toArray('one,,,two,tree,'));
    }

    public function testSnakecaseToCamelcase()
    {
        self::assertEquals(
            'SnakeCaseVariable',
            StringHelper::snakecaseToCamelcase('snake_case_variable')
        );

        self::assertEquals(
            'SnakeCaseVariable',
            StringHelper::snakecaseToCamelcase('_snake_case_variable')
        );

        self::assertEquals(
            'SnakeCaseVariable',
            StringHelper::snakecaseToCamelcase('snake_case__variable_')
        );

        self::assertEquals(
            'SnakeCase100Variable',
            StringHelper::snakecaseToCamelcase('snake_case_100_variable_')
        );

        self::assertEquals(
            'snakeCaseVariable',
            StringHelper::snakecaseToCamelcase('snake_case_variable', true)
        );
    }

    public function testCamelcaseToSnakecase()
    {
        self::assertEquals(
            'snake_case_variable',
            StringHelper::camelcaseToSnakecase('SnakeCaseVariable')
        );

        self::assertEquals(
            'snake_case_variable',
            StringHelper::camelcaseToSnakecase('snakeCaseVariable')
        );

        self::assertEquals(
            'snake_case_variable',
            StringHelper::camelcaseToSnakecase('SnakeCASEVariable')
        );

        self::assertEquals(
            'snake_case100_variable',
            StringHelper::camelcaseToSnakecase('SnakeCASE100Variable')
        );
    }
}
