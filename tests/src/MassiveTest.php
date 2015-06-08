<?php

namespace Nameless\Utilities\Tests;

class MassiveTest extends \PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        self::assertEquals(\Nameless\Utilities\Massive\toString([1, 2, 3]), '1, 2, 3');
        self::assertEquals(\Nameless\Utilities\Massive\toString([]), '');
        self::assertEquals(\Nameless\Utilities\Massive\toString(['one', 'two', ''], ':'), 'one:two');
    }
}
