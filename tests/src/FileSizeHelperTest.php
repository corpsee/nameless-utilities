<?php

namespace Nameless\Utilities\Tests;

use Nameless\Utilities\FileSizeHelper;

class FileSizeHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testHumanize()
    {
        self::assertEquals(FileSizeHelper::humanize(512), '512.00B');
        self::assertEquals(FileSizeHelper::humanize(1024, 0), '1KB');
        self::assertEquals(FileSizeHelper::humanize(1000000000), '953.67MB');
        self::assertEquals(FileSizeHelper::humanize(1000000000, 0), '954MB');
        self::assertEquals(FileSizeHelper::humanize(1000000000, 4), '953.6743MB');
    }

    public function testUnhumanize()
    {
        self::assertEquals(FileSizeHelper::unhumanize('1KB'), 1024);
        self::assertEquals(FileSizeHelper::unhumanize('953.67MB'), 999995474);
        self::assertEquals(FileSizeHelper::unhumanize('954MB'), 1000341504);
    }
}
