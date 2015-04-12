<?php

namespace Nameless\Utilities\Tests;

class FilesizeTest extends \PHPUnit_Framework_TestCase
{
    public function testHumanize()
    {
        $this->assertEquals(\Nameless\Utilities\Filesize\humanize(512), '512.00B');
        $this->assertEquals(\Nameless\Utilities\Filesize\humanize(1024, 0), '1KB');
        $this->assertEquals(\Nameless\Utilities\Filesize\humanize(1000000000), '953.67MB');
        $this->assertEquals(\Nameless\Utilities\Filesize\humanize(1000000000, 0), '954MB');
        $this->assertEquals(\Nameless\Utilities\Filesize\humanize(1000000000, 4), '953.6743MB');
    }

    public function testUnhumanize()
    {
        $this->assertEquals(\Nameless\Utilities\Filesize\unhumanize('1KB'), 1024);
        $this->assertEquals(\Nameless\Utilities\Filesize\unhumanize('953.67MB'), 999995474);
        $this->assertEquals(\Nameless\Utilities\Filesize\unhumanize('954MB'), 1000341504);
    }
}
