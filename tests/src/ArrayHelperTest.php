<?php

namespace Nameless\Utilities\Tests;

use Nameless\Utilities\ArrayHelper;

class ArrayHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        self::assertEquals('1, 2, 3', ArrayHelper::toString([1, 2, 3]));
        self::assertEquals('', ArrayHelper::toString([]));
        self::assertEquals('one:two', ArrayHelper::toString(['one', 'two', ''], ':'));
    }

    public function testGet()
    {
        self::assertEquals(1, ArrayHelper::get(['one' => 1, 'two' => 2, 'three' => 3], 'one'));
        self::assertEquals(null, ArrayHelper::get(['one' => 1, 'two' => 2, 'three' => 3], 'four'));
        self::assertEquals(4, ArrayHelper::get(['one' => 1, 'two' => 2, 'three' => 3], 'four', 4));

        self::assertEquals('one', ArrayHelper::get([0 => 'one', 1 => 'two', 2 => 'three'], 0));
        self::assertEquals(null, ArrayHelper::get([0 => 'one', 1 => 'two', 2 => 'three'], 3));
        self::assertEquals(4, ArrayHelper::get([0 => 'one', 1 => 'two', 2 => 'three'], 3, 4));
    }
}
