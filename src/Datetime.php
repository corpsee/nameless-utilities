<?php

/**
 * Nameless utilities package
 *
 * @copyright Copyright 2015, Corpsee.
 * @license   https://github.com/corpsee/nameless-utilities/blob/master/LICENSE
 * @link      https://github.com/corpsee/nameles-utilities
 */

namespace Nameless\Utilities\Datetime;

function humanize($second, $format = '%s years %s months %s days %s hours %s minutes % seconds') {
    $result = '';

    if ($second >= 3600) {
        $result .= (floor($second / 3600) < 10 ? '0' : '') . floor($second / 3600) . ':';
        $second = ($second % 3600);
    } else {
        $result .= '00:';
    }

    if ($second >= 60) {
        $result .= (floor($second / 60) < 10 ? '0' : '') . floor($second / 60) . ':';
        $second = ($second % 60);
    } else {
        $result .= '00:';
    }

    $result .= ($second < 10 ? '0' : '' ) . $second;

    return $result;
}
