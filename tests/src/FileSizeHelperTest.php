<?php

namespace Nameless\Utilities\Tests;

use Nameless\Utilities\FileSizeHelper;
use PHPUnit\Framework\TestCase;

class FileSizeHelperTest extends TestCase
{
    public function testHumanize()
    {
        $localParams = localeconv();

        self::assertEquals('512' . $localParams['decimal_point'] . '00B', FileSizeHelper::humanize(512));
        self::assertEquals('1KB', FileSizeHelper::humanize(1024, 0));

        self::assertEquals(
            ('953' . $localParams['decimal_point'] . '67MB'),
            FileSizeHelper::humanize(1000000000)
        );

        self::assertEquals('954MB', FileSizeHelper::humanize(1000000000, 0));

        self::assertEquals(
            ('953' . $localParams['decimal_point'] . '6743MB'),
            FileSizeHelper::humanize(1000000000, 4)
        );

        self::assertEquals(
            '827180612553YB',
            FileSizeHelper::humanize(1000000000000000000000000000000000000, 0)
        );
    }

    public function testUnhumanize()
    {
        self::assertEquals(1024, FileSizeHelper::unhumanize('1 KB'));
        self::assertEquals(999995474, FileSizeHelper::unhumanize('953.67MB'));
        self::assertEquals(1000341504, FileSizeHelper::unhumanize('954MB'));
    }
}
