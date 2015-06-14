<?php

/**
 * Nameless utilities
 *
 * @copyright Copyright 2015, Corpsee.
 * @license   https://github.com/corpsee/nameless-utilities/blob/master/LICENSE
 * @link      https://github.com/corpsee/nameles-utilities
 */

namespace Nameless\Utilities\Datetime;

/**
 * @param integer $seconds
 * @param array   $format
 *
 * @return string
 */
function humanize(
    $seconds,
    $format = [
        ['second', 'seconds'],
        ['minute', 'minutes'],
        ['hour', 'hours'],
        ['day', 'days'],
        ['month', 'months'],
        ['year', 'years']
    ]
) {
    if ($seconds < 1) {
        return '0 ' . $format[0];
    }

    $periods = [
        365 * 24 * 60 * 60 => 5,
        30 * 24 * 60 * 60  => 4,
        24 * 60 * 60       => 3,
        60 * 60            => 2,
        60                 => 1,
        1                  => 0
    ];

    $humanized = '';
    foreach ($periods as $secs => $index) {
        $count   = $seconds / $secs;
        if ($count >= 1) {
            $count     = (integer)round($count);
            $seconds   -= $count * $secs;
            $humanized .= $count . ' ' . ($count > 1 ? $format[$index][1] : $format[$index][0]) . ' ';
        }
    }

    return rtrim($humanized);
}
