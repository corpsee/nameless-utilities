<?php

/**
 * Nameless utilities package
 *
 * @copyright Copyright 2015, Corpsee.
 * @license   https://github.com/corpsee/nameless-utilities/blob/master/LICENSE
 * @link      https://github.com/corpsee/nameles-utilities
 */

namespace Nameless\Utilities\Url;

/**
 * @param string $url
 * @param string $public_path
 *
 * @return string
 */
function toPath($url, $public_path)
{
    $unix_public = rtrim(str_replace('\\', '/', $public_path), '\\/') . '/';

    return $unix_public . ltrim($url, '/');
}
