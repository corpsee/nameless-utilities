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
}
