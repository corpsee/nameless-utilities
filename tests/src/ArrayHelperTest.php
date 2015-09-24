<?php

namespace Nameless\Utilities\Tests;

class ArrayHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        self::assertEquals(\Nameless\Utilities\ArrayHelper\toString([1, 2, 3]), '1, 2, 3');
        self::assertEquals(\Nameless\Utilities\ArrayHelper\toString([]), '');
        self::assertEquals(\Nameless\Utilities\ArrayHelper\toString(['one', 'two', ''], ':'), 'one:two');
    }
}
