<?php

namespace Nameless\Utilities\Tests;

class StringsTest extends \PHPUnit_Framework_TestCase
{
    public function testStartWith()
    {
        $this->assertTrue(\Nameless\Utilities\Strings\startWith('example', 'exa'));
        $this->assertTrue(\Nameless\Utilities\Strings\startWith('пример', 'пр'));
    }
    
    public function testEndWith()
    {
        $this->assertTrue(\Nameless\Utilities\Strings\endWith('example', 'ample'));
        $this->assertTrue(\Nameless\Utilities\Strings\endWith('пример', 'мер'));
    }

    public function testContains()
    {
        $this->assertTrue(\Nameless\Utilities\Strings\contains('example', 'xampl'));
        $this->assertTrue(\Nameless\Utilities\Strings\contains('пример', 'им'));
    }

    public function testCut()
    {
        $this->assertEquals(\Nameless\Utilities\Strings\cut('example', 6), 'exampl...');
        $this->assertEquals(\Nameless\Utilities\Strings\cut('пример', 3), 'при...');
    }

    public function testCutWords()
    {
        $this->assertEquals(\Nameless\Utilities\Strings\cutWords('simple example', 1), 'simple...');
        $this->assertEquals(\Nameless\Utilities\Strings\cutWords('очень простой пример', 2), 'очень простой...');
    }
    
    public function testTransliterate()
    {
        $this->assertEquals(\Nameless\Utilities\Strings\transliterate('очень простой пример'), 'ochen prostoj primer');
        $this->assertEquals(\Nameless\Utilities\Strings\transliterate('velmi jednoduchý příklad'), 'velmi jednoduchy priklad');
    }
    
    public function testStandardize()
    {
        $this->assertEquals(\Nameless\Utilities\Strings\standardize('очень простой   Пример', '-'), 'ochen-prostoj-primer');
        $this->assertEquals(\Nameless\Utilities\Strings\standardize(' Velmi:;+ Jednoduchý___příklad  '), 'velmi_jednoduchy_priklad');
    }
}
