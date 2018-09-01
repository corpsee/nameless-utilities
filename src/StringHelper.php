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
 * Class StringHelper
 *
 * @author Corpsee <poisoncorpsee@gmail.com>
 */
class StringHelper
{
    const RUSSIAN_RULES = 'Russian-Latin/BGN';

    /**
     * @param string $haystack
     * @param string $needle
     *
     * @return boolean
     */
    public static function startWith(string $haystack, string $needle): bool
    {
        return ($needle === mb_substr($haystack, 0, mb_strlen($needle, 'UTF-8'), 'UTF-8'));
    }

    /**
     * @param string $haystack
     * @param string $needle
     *
     * @return boolean
     */
    public static function endWith(string $haystack, string $needle): bool
    {
        return ($needle === mb_substr($haystack, -mb_strlen($needle, 'UTF-8'), null, 'UTF-8'));
    }

    /**
     * @param string $haystack
     * @param string $needle
     *
     * @return boolean
     */
    public static function contains(string $haystack, string $needle): bool
    {
        return mb_strpos($haystack, $needle, 0, 'UTF-8') !== false;
    }

    /**
     * @param string  $string
     * @param integer $limit
     * @param string  $append
     *
     * @return string
     */
    public static function cut(string $string, int $limit = 25, string $append = '...'): string
    {
        if (mb_strlen($string, 'UTF-8') <= $limit) {
            return $string;
        }

        return rtrim(mb_substr($string, 0, $limit, 'UTF-8')) . $append;
    }

    /**
     * @param string  $string
     * @param integer $limit
     * @param string  $append
     *
     * @return string
     */
    public static function cutWords(string $string, int $limit = 25, string $append = '...'): string
    {
        preg_match('/^\s*+(?:\S++\s*+){1,' . $limit . '}/u', $string, $matches);
        if (!isset($matches[0]) || mb_strlen($string, 'UTF-8') === mb_strlen($matches[0], 'UTF-8')) {
            return $string;
        }

        return rtrim($matches[0]) . $append;
    }

    /**
     * @see http://demo.icu-project.org/icu-bin/translit
     * 
     * @param string $string
     * @param string $rules
     *
     * @return string
     */
    public static function transliterate(string $string, string $rules): string
    {
        return transliterator_transliterate($rules, $string);
    }

    /**
     * @param string $string
     * @param string $rules
     * @param string $separator
     *
     * @return string
     */
    public static function standardize(string $string, string $rules, string $separator = '_'): string
    {
        $string = self::transliterate($string, $rules);
        $string = trim($string);
        $string = strtolower($string);

        return preg_replace(['#[-_\s]+#', '#[^' . $separator . '\w\d]+#i'], [$separator, ''], $string);
    }

    /**
     * @param string $string
     * @param string $delimiter
     *
     * @return array
     */
    public static function toArray(string $string, string $delimiter = ','): array
    {
        $arrayTemp = explode($delimiter, $string);
        $array = [];
        foreach ($arrayTemp as $item) {
            $itemClear = trim($item);
            if ($itemClear) {
                $array[] = $itemClear;
            }
        }

        return $array;
    }

    /**
     * @param string $string
     * @param bool   $lower
     *
     * @return string
     */
    public static function snakecaseToCamelcase(string $string, bool $lower = false): string
    {
        $words = explode('_', $string);

        array_walk($words, function (&$word, $index) {
            $word = ucfirst($word);
        });

        if ($lower) {
            return lcfirst(implode($words));
        }

        return implode($words);
    }

    /**
     * @param $string
     *
     * @return string
     */
    public static function camelcaseToSnakecase(string $string): string
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $string, $matches);

        $words = $matches[0];
        foreach ($words as &$word) {
            $word = ($word == strtoupper($word))
                ? strtolower($word)
                : lcfirst($word);
        }

        return implode('_', $words);
    }
}
