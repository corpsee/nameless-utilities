<?php

namespace Nameless\Utilities\Tests;

class FilesizeTest extends \PHPUnit_Framework_TestCase
{
    public function testHumanize()
    {
        $this->assertEquals(\Nameless\Utilities\Filesize\humanize(1024), '1.00KB');
    }
    
    public function testUnhumanize()
    {
        $this->assertEquals(\Nameless\Utilities\Filesize\unhumanize('1.00KB'), 1024);
    }
}
