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
 * Class PathHelper
 *
 * @author Corpsee <poisoncorpsee@gmail.com>
 */
class PathHelper
{
    /**
     * @param string $path
     * @param string $publicPath
     *
     * @return string
     */
    public static function toURL(string $path, string $publicPath): string
    {
        $unixPublic = rtrim(str_replace('\\', '/', $publicPath), '\\/') . '/';
        $path = str_replace('\\', '/', $path);

        return str_replace([$unixPublic], '/', $path);
    }
}
