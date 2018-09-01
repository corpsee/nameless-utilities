<?php

namespace Nameless\Utilities\Tests;

use Nameless\Utilities\UrlHelper;
use PHPUnit\Framework\TestCase;

class UrlHelperTest extends TestCase
{
    public function testToPath()
    {
        self::assertEquals(
            '/var/www/example.com/public/path/to/url',
            UrlHelper::toPath(
                '/path/to/url',
                '/var/www/example.com/public/'
            )
        );

        self::assertEquals(
            '/var/www/example.com/public/path/to/url',
            UrlHelper::toPath(
                '/path/to/url',
                '/var/www/example.com/public'
            )
        );

        self::assertEquals(
            'C:/www/example.com/public/path/to/url',
            UrlHelper::toPath(
                '/path/to/url',
                'C:\www\example.com\public'
            )
        );
    }
}
