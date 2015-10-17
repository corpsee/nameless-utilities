<?php

namespace Nameless\Utilities\Tests;

use Nameless\Utilities\ArrayHelper;

class ArrayHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        self::assertEquals(ArrayHelper::toString([1, 2, 3]), '1, 2, 3');
        self::assertEquals(ArrayHelper::toString([]), '');
        self::assertEquals(ArrayHelper::toString(['one', 'two', ''], ':'), 'one:two');
    }

    public function testGet()
    {
        self::assertEquals(ArrayHelper::get(['one' => 1, 'two' => 2, 'three' => 3], 'one'), 1);
        self::assertEquals(ArrayHelper::get(['one' => 1, 'two' => 2, 'three' => 3], 'four'), null);
        self::assertEquals(ArrayHelper::get(['one' => 1, 'two' => 2, 'three' => 3], 'four', 4), 4);

        self::assertEquals(ArrayHelper::get([0 => 'one', 1 => 'two', 2 => 'three'], 0), 'one');
        self::assertEquals(ArrayHelper::get([0 => 'one', 1 => 'two', 2 => 'three'], 3), null);
        self::assertEquals(ArrayHelper::get([0 => 'one', 1 => 'two', 2 => 'three'], 3, 4), 4);
    }
}
