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

    $power = (integer)floor((strlen($bytes) - 1) / 3);
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
    ];

    $bytes = (float)$size_string;

    if (preg_match('#([KMGTP]?B)$#si', $size_string, $matches) && !empty($sizes[$matches[1]])) {
        $bytes = $bytes * $sizes[$matches[1]];
    }

    return (integer)round($bytes);
}