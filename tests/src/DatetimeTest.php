<?php

namespace Nameless\Utilities\Tests;

class DatetimeTest extends \PHPUnit_Framework_TestCase
{
    public function testHumanize()
    {
        self::assertEquals(\Nameless\Utilities\Datetime\humanize(34218060), '1 year 1 month 1 day 1 hour 1 minute');
        self::assertEquals(\Nameless\Utilities\Datetime\humanize(34218062), '1 year 1 month 1 day 1 hour 1 minute 2 seconds');
        self::assertEquals(\Nameless\Utilities\Datetime\humanize(120), '2 minutes');
        self::assertEquals(\Nameless\Utilities\Datetime\humanize(
            121,
            [['сек.', 'сек.'], ['мин.', 'мин.'], ['ч.', 'ч.'], ['д.', 'д.'], ['мес.', 'мес.'], ['г.', 'г.']]
        ),'2 мин. 1 сек.');
    }
}
