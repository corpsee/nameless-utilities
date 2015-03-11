<?php

namespace Nameless\Utilities\Tests;

class StringsTest extends \PHPUnit_Framework_TestCase
{
    public function testStartWith()
    {
        $this->assertTrue(\Nameless\Utilities\Strings\startWith('example', 'exa'));
    }
}
