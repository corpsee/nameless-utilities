<?php

namespace Nameless\Utilities\Tests;

class StringsTest extends \PHPUnit_Framework_TestCase
{
    public function testStartWith()
    {
        $this->assertTrue(\Nameless\Utilities\Strings\startWith('example', 'exa'));
    }
    
    public function testEndWith()
    {
        $this->assertTrue(\Nameless\Utilities\Strings\endWith('example', 'xample'));
    }
}
