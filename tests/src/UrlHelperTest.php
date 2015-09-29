<?php

namespace Nameless\Utilities\Tests;

use Nameless\Utilities\UrlHelper;

class UrlHelperTest extends \PHPUnit_Framework_TestCase
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
