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
 * Class FileSizeHelper
 *
 * @author Corpsee <poisoncorpsee@gmail.com>
 */
class FileSizeHelper
{
    /**
     * @param integer|float $bytes
     * @param integer       $decimals
     * @param array         $sizes
     *
     * @return string
     */
    public static function humanize(
        $bytes,
        int $decimals = 2,
        array $sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']
    ): string
    {
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
     * @param string $sizeString
     * @param array  $sizes
     *
     * @return integer
     */
    public static function unhumanize(
        string $sizeString,
        array $sizes = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']
    ): int
    {
        $sizeString = trim($sizeString);

        $sizesPower = [];
        foreach ($sizes as $index => $size) {
            $sizesPower[$size] = pow(1024, $index);
        }

        $bytes = (float)$sizeString;

        $pattern = implode('|', $sizes);
        if (
            preg_match('#(' . $pattern . ')$#si', $sizeString, $matches) &&
            $matches[1] &&
            isset($sizesPower[$matches[1]])
        ) {
            $bytes *= $sizesPower[$matches[1]];
        }

        return (integer)round($bytes);
    }
}
