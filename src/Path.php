<?php

/**
 * Nameless utilities
 *
 * @copyright Copyright 2015, Corpsee.
 * @license   https://github.com/corpsee/nameless-utilities/blob/master/LICENSE
 * @link      https://github.com/corpsee/nameles-utilities
 */

namespace Nameless\Utilities\Path;

/**
 * @param string $path
 * @param string $public_path
 *
 * @return string
 */
function toURL($path, $public_path)
{
    $unix_public = rtrim(str_replace('\\', '/', $public_path), '\\/') . '/';
    $path        = str_replace('\\', '/', $path);

    return str_replace([$unix_public], '/', $path);
}
