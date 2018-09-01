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
 * Class ArrayHelper
 *
 * @author Corpsee <poisoncorpsee@gmail.com>
 */
class ArrayHelper
{
    /**
     * @param array          $array
     * @param string|integer $key
     * @param mixed          $default
     *
     * @return mixed
     */
    public static function get(array $array, $key, $default = null)
    {
        return isset($array[$key])
            ? $array[$key]
            : $default;
    }

    /**
     * @param array  $array
     * @param string $delimiter
     *
     * @return string
     */
    public static function toString(array $array, string $delimiter = ', '): string
    {
        if (!$array) {
            return '';
        }

        foreach ($array as $key => $value) {
            if (!$value) {
                unset($array[$key]);
            }
        }

        return implode($delimiter, $array);
    }
}
