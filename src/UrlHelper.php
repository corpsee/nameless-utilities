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
 * Class UrlHelper
 *
 * @author Corpsee <poisoncorpsee@gmail.com>
 */
class UrlHelper
{
    /**
     * @param string $url
     * @param string $publicPath
     *
     * @return string
     */
    public static function toPath(string $url, string $publicPath): string
    {
        $unixPublic = rtrim(str_replace('\\', '/', $publicPath), '\\/') . '/';

        return $unixPublic . ltrim($url, '/');
    }
}
