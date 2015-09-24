<?php

/**
 * Nameless utilities
 *
 * @copyright Copyright 2015, Corpsee.
 * @license   https://github.com/corpsee/nameless-utilities/blob/master/LICENSE
 * @link      https://github.com/corpsee/nameles-utilities
 */

namespace Nameless\Utilities\ArrayHelper;

/**
 * @param array  $array
 * @param string $delimiter
 *
 * @return string
 */
function toString(array $array, $delimiter = ', ')
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
