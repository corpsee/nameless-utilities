<?php

namespace Nameless\Utilities\Tests;

class StringsTest extends \PHPUnit_Framework_TestCase
{
    public function testStartWith()
    {
        self::assertTrue(\Nameless\Utilities\Strings\startWith('example', 'exa'));
        self::assertTrue(\Nameless\Utilities\Strings\startWith('пример', 'пр'));
    }
    
    public function testEndWith()
    {
        self::assertTrue(\Nameless\Utilities\Strings\endWith('example', 'ample'));
        self::assertTrue(\Nameless\Utilities\Strings\endWith('пример', 'мер'));
    }

    public function testContains()
    {
        self::assertTrue(\Nameless\Utilities\Strings\contains('example', 'xampl'));
        self::assertTrue(\Nameless\Utilities\Strings\contains('пример', 'им'));
    }

    public function testCut()
    {
        self::assertEquals(\Nameless\Utilities\Strings\cut('example', 6), 'exampl...');
        self::assertEquals(\Nameless\Utilities\Strings\cut('пример', 3), 'при...');
    }

    public function testCutWords()
    {
        self::assertEquals(\Nameless\Utilities\Strings\cutWords('simple example', 1), 'simple...');
        self::assertEquals(\Nameless\Utilities\Strings\cutWords('очень простой пример', 2), 'очень простой...');
    }
    
    public function testTransliterate()
    {
        self::assertEquals(\Nameless\Utilities\Strings\transliterate('очень простой пример'), 'ochen prostoj primer');
        self::assertEquals(\Nameless\Utilities\Strings\transliterate('velmi jednoduchý příklad'), 'velmi jednoduchy priklad');
    }
    
    public function testStandardize()
    {
        self::assertEquals(\Nameless\Utilities\Strings\standardize('очень простой   Пример', '-'), 'ochen-prostoj-primer');
        self::assertEquals(\Nameless\Utilities\Strings\standardize(' Velmi:;+ Jednoduchý___příklad  '), 'velmi_jednoduchy_priklad');
    }
}
