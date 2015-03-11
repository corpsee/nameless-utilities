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
 * @param string $encoding
 *
 * @return boolean
 */
function startWith($haystack, $needle, $encoding = 'UTF-8') {
    return ($needle === mb_substr($haystack, 0, mb_strlen($needle, $encoding), $encoding));
}

/**
 * @param string $haystack
 * @param string $needle
 * @param string $encoding
 *
 * @return boolean
 */
function endWith($haystack, $needle, $encoding = 'UTF-8') {
    return ($needle === mb_substr($haystack, -mb_strlen($needle, $encoding), null, $encoding));
}

/**
 * @param string $haystack
 * @param string $needle
 * @param string $encoding
 *
 * @return boolean
 */
function contains($haystack, $needle, $encoding = 'UTF-8') {
    return mb_strpos($haystack, $needle, null, $encoding) !== false;
}

/**
 * @param string  $string
 * @param integer $limit
 * @param string  $append
 * @param string  $encoding
 *
 * @return string
 */
function cut($string, $limit = 25, $append = '...', $encoding = 'UTF-8') {
    if (mb_strlen($string, $encoding) <= $limit) {
        return $string;
    }
    return rtrim(mb_substr($string, 0, $limit, $encoding)) . $append;
}

/**
 * @param string  $string
 * @param integer $limit
 * @param string  $append
 * @param string  $encoding
 *
 * @return string
 */
function cutWords($string, $limit = 100, $append = '...', $encoding = 'UTF-8') {
    preg_match('/^\s*+(?:\S++\s*+){1,' . $limit . '}/u', $string, $matches);
    if (!isset($matches[0]) || mb_strlen($string, $encoding) === mb_strlen($matches[0], $encoding)) {
        return $string;
    }
    return rtrim($matches[0]) . $append;
}

