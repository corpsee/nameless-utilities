<?php

namespace Nameless\Utilities\Tests;

use Nameless\Utilities\DateTimeHelper;

class DateTimeHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testHumanize()
    {
        self::assertEquals(DateTimeHelper::humanize(34218060), '1 year 1 month 1 day 1 hour 1 minute');
        self::assertEquals(DateTimeHelper::humanize(34218062), '1 year 1 month 1 day 1 hour 1 minute 2 seconds');
        self::assertEquals(DateTimeHelper::humanize(120), '2 minutes');
        self::assertEquals(
            DateTimeHelper::humanize(
                121, [
                    ['сек.', 'сек.'],
                    ['мин.', 'мин.'],
                    ['ч.', 'ч.'],
                    ['д.', 'д.'],
                    ['мес.', 'мес.'],
                    ['г.', 'г.']
                ]
            ),
            '2 мин. 1 сек.'
        );
    }
}
