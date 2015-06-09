<?php

namespace Nameless\Utilities\Tests;

class PathTest extends \PHPUnit_Framework_TestCase
{
    public function testToUrl()
    {
        self::assertEquals(
            '/path/to/url',
            \Nameless\Utilities\Path\toURL(
                '/var/www/example.com/public/path/to/url',
                '/var/www/example.com/public/'
            )
        );

        self::assertEquals(
            '/path/to/url',
            \Nameless\Utilities\Path\toURL(
                '/var/www/example.com/public/path/to/url',
                '/var/www/example.com/public/'
            )
        );

        self::assertEquals(
            '/path/to/url',
            \Nameless\Utilities\Path\toURL(
                '/var/www/example.com/public/path/to/url',
                '/var/www/example.com/public'
            )
        );

        self::assertEquals(
            '/path/to/url',
            \Nameless\Utilities\Path\toURL(
                'C:\www\example.com\public\path\to\url',
                'C:\www\example.com\public\\'
            )
        );

        self::assertEquals(
            '/path/to/url',
            \Nameless\Utilities\Path\toURL(
                '/var/www/example.com/public/path/to/url',
                '\var\www\example.com\public'
            )
        );
    }
}
