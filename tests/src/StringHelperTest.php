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
        self::assertEquals(StringHelper::cut('example', 6), 'exampl...');
        self::assertEquals(StringHelper::cut('пример', 3), 'при...');
        self::assertEquals(StringHelper::cut('пример', 6), 'пример');
        self::assertEquals(StringHelper::cut('пример', 7), 'пример');
    }

    public function testCutWords()
    {
        self::assertEquals(StringHelper::cutWords('simple example', 1), 'simple...');
        self::assertEquals(StringHelper::cutWords('очень простой пример', 2), 'очень простой...');
        self::assertEquals(StringHelper::cutWords('очень простой', 3), 'очень простой');
    }

    public function testTransliterate()
    {
        self::assertEquals(StringHelper::transliterate('очень простой пример'), 'ochen prostoj primer');
        self::assertEquals(StringHelper::transliterate('velmi jednoduchý příklad'), 'velmi jednoduchy priklad');
    }

    public function testStandardize()
    {
        self::assertEquals(StringHelper::standardize('очень простой   Пример', '-'), 'ochen-prostoj-primer');
        self::assertEquals(StringHelper::standardize(' Velmi:;+ Jednoduchý___příklad  '), 'velmi_jednoduchy_priklad');
    }

    public function testToArray()
    {
        self::assertEquals(StringHelper::toArray('1,2,3,'), ['1', '2', '3']);
        self::assertEquals(StringHelper::toArray('one,,,two,tree,'), ['one', 'two', 'tree']);
    }
}
