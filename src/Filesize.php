<?php

/**
 * Nameless utilities package
 *
 * @copyright Copyright 2015, Corpsee.
 * @license   https://github.com/corpsee/nameless-utilities/blob/master/LICENSE
 * @link      https://github.com/corpsee/nameles-utilities
 */

namespace Nameless\Utilities\Filesize;

/**
 * @param integer $bytes
 * @param integer $decimals
 *
 * @return string
 */
function humanize($bytes, $decimals = 2)
{
    $sizes = [
        'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'
    ];

    $power = 0;
    $temp  = $bytes;
    foreach ($sizes as $size) {
        if ($temp >= 1024) {
            $temp /= 1024;
            $power++;
        } else {
            break;
        }
    }

    if (isset($sizes[$power])) {
        $humanize = sprintf("%.{$decimals}f", ($bytes / pow(1024, $power))) . $sizes[$power];
    } else {
        $humanize = sprintf("%i", $bytes) . 'B';
    }
    
    return $humanize;
}

/**
 * @param string $size_string
 *
 * @return integer
 */
function unhumanize($size_string)
{
    $sizes = [
        'B'  => 1,
        'KB' => 1024,
        'MB' => pow(1024, 2),
        'GB' => pow(1024, 3),
        'TB' => pow(1024, 4),
        'PB' => pow(1024, 5),
        'EB' => pow(1024, 6),
        'ZB' => pow(1024, 7),
        'YB' => pow(1024, 8),
    ];

    $bytes = (float)$size_string;

    if (preg_match('#([KMGTPEZY]?B)$#si', $size_string, $matches) && !empty($sizes[$matches[1]])) {
        $bytes = $bytes * $sizes[$matches[1]];
    }

    return (integer)round($bytes);
}