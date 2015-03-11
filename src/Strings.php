<?php

/**
 * Nameless utilities package
 *
 * @copyright Copyright 2015, Corpsee.
 * @license   https://github.com/corpsee/nameless-debug/blob/master/LICENSE
 * @link      https://github.com/corpsee/nameles-debug
 */

namespace Nameless\Utilities\Strings;

/**
 * @param string $haystack
 * @param string $needle
 *
 * @return boolean
 */
function startWith($haystack, $needle) {
    return substr($haystack, 0, mb_strlen($needle, 'UTF-8')) === $needle;
}

/**
 * @param string $haystack
 * @param string $needle
 *
 * @return boolean
 */
function endWith($haystack, $needle) {
    return substr($haystack, -mb_strlen($needle, 'UTF-8')) === $needle;
}

