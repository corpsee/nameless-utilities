<?php

namespace Nameless\Utilities\Tests;

use Nameless\Utilities\DateTimeHelper;

class DateTimeHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testHumanize()
    {
        self::assertEquals('300 milliseconds', DateTimeHelper::humanize(0.3));
        self::assertEquals('61 microseconds', DateTimeHelper::humanize(0.000061));

        self::assertEquals(
            '1 year 1 month 1 day 1 hour 1 minute',
            DateTimeHelper::humanize(34218060)
        );

        self::assertEquals(
            '1 year 1 month 1 day 1 hour 1 minute 2 seconds',
            DateTimeHelper::humanize(34218062)
        );

        self::assertEquals('2 minutes', DateTimeHelper::humanize(120));

        self::assertEquals(
            '2 minutes 6 milliseconds 111 microseconds',
            DateTimeHelper::humanize(120.006111)
        );

        self::assertEquals(
            '2 мин 1 с',
            DateTimeHelper::humanize(
                121, [
                    ['мкс', 'мкс'],
                    ['мс', 'мс'],
                    ['с', 'с'],
                    ['мин', 'мин'],
                    ['ч', 'ч'],
                    ['д', 'д'],
                    ['мес', 'мес'],
                    ['г', 'г'],
                ]
            )
        );
    }
}
