<?php

declare(strict_types = 1);

/**
 * Nameless utilities
 *
 * @package   Nameless utilities
 * @copyright Copyright 2015, Corpsee.
 * @license   https://github.com/corpsee/nameless-utilities/blob/master/LICENSE
 * @link      https://github.com/corpsee/nameles-utilities
 */

namespace Nameless\Utilities;

/**
 * Class DateTimeHelper
 *
 * @author Corpsee <poisoncorpsee@gmail.com>
 */
class DateTimeHelper
{
    /**
     * @param integer|float $seconds
     * @param array         $format
     *
     * @return string
     */
    public static function humanize(
        $seconds,
        array $format = [
            ['microsecond', 'microseconds'],
            ['millisecond', 'milliseconds'],
            ['second', 'seconds'],
            ['minute', 'minutes'],
            ['hour', 'hours'],
            ['day', 'days'],
            ['month', 'months'],
            ['year', 'years'],
        ]
    ): string
    {
        $seconds = $seconds * 1000000;

        $periods = [
            365 * 24 * 60 * 60 * 1000000 => 7,
            30 * 24 * 60 * 60 * 1000000  => 6,
            24 * 60 * 60 * 1000000       => 5,
            60 * 60 * 1000000            => 4,
            60 * 1000000                 => 3,
            1000000                      => 2,
            1000                         => 1,
            1                            => 0,
        ];

        $humanized = '';
        foreach ($periods as $secs => $index) {
            $count = $seconds / $secs;
            if ($count >= 1) {
                $count = (integer)round($count);
                $seconds -= $count * $secs;
                $humanized .= $count . ' ' . ($count > 1 ? $format[$index][1] : $format[$index][0]) . ' ';
            }
        }

        return rtrim($humanized);
    }
}
