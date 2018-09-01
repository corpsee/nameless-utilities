<?php

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
 * Class FileSizeHelper
 *
 * @author Corpsee <poisoncorpsee@gmail.com>
 */
class FileSizeHelper
{
    /**
     * @param integer $bytes
     * @param integer $decimals
     * @param array   $sizes
     *
     * @return string
     */
    public static function humanize(
        $bytes,
        $decimals = 2,
        array $sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']
    ) {
        $power = 0;
        $temp = $bytes;
        $count = (count($sizes) - 1);
        for ($i = 0; $i < $count; $i++) {
            if ($temp < 1024) {
                break;
            } else {
                $temp /= 1024;
                $power++;
            }
        }

        $humanize = sprintf("%.{$decimals}f", ($bytes / pow(1024, $power))) . $sizes[$power];

        return $humanize;
    }

    /**
     * @param string $size_string
     * @param array  $sizes
     *
     * @return integer
     */
    public static function unhumanize(
        $size_string,
        array $sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']
    ) {
        $size_string = trim($size_string);

        $sizes_power = [];
        foreach ($sizes as $index => $size) {
            $sizes_power[$size] = pow(1024, $index);
        }

        $bytes = (float)$size_string;

        $pattern = implode('|', $sizes);
        if (
            preg_match('#(' . $pattern . ')$#si', $size_string, $matches) &&
            $matches[1] &&
            isset($sizes_power[$matches[1]])
        ) {
            $bytes *= $sizes_power[$matches[1]];
        }

        return (integer)round($bytes);
    }
}
