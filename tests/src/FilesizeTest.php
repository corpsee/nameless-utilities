<?php

namespace Nameless\Utilities\Tests;

class FilesizeTest extends \PHPUnit_Framework_TestCase
{
    public function testHumanize()
    {
        self::assertEquals(\Nameless\Utilities\Filesize\humanize(512), '512.00B');
        self::assertEquals(\Nameless\Utilities\Filesize\humanize(1024, 0), '1KB');
        self::assertEquals(\Nameless\Utilities\Filesize\humanize(1000000000), '953.67MB');
        self::assertEquals(\Nameless\Utilities\Filesize\humanize(1000000000, 0), '954MB');
        self::assertEquals(\Nameless\Utilities\Filesize\humanize(1000000000, 4), '953.6743MB');
    }

    public function testUnhumanize()
    {
        self::assertEquals(\Nameless\Utilities\Filesize\unhumanize('1KB'), 1024);
        self::assertEquals(\Nameless\Utilities\Filesize\unhumanize('953.67MB'), 999995474);
        self::assertEquals(\Nameless\Utilities\Filesize\unhumanize('954MB'), 1000341504);
    }
}
