<?php

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
 * Class BcMathHelper
 *
 * @author Corpsee <poisoncorpsee@gmail.com>
 */
class BcMathHelper
{
    /**
     * @param mixed $left_operand
     * @param mixed $right_operand
     *
     * @return array
     */
    protected static function normalizeArgs($left_operand, $right_operand)
    {
        $left_operand = self::normalizeNumber($left_operand);
        $right_operand = self::normalizeNumber($right_operand);

        return [
            $left_operand,
            $right_operand,
        ];
    }

    /**
     * @param string|float $number
     *
     * @return string
     */
    public static function normalizeNumber($number)
    {
        $number = str_replace([',', ' '], ['.', ''], (string)$number);

        if (
            (($e = strrchr($number, 'e')) !== false) ||
            (($e = strrchr($number, 'E')) !== false)
        ) {
            $number = number_format($number, -intval(substr($e, 1)));
        }

        return $number;
    }

    /**
     * @param mixed    $left_operand
     * @param mixed    $right_operand
     * @param int|null $scale
     *
     * @return float
     */
    public static function add($left_operand, $right_operand, $scale = null)
    {
        list($left_operand, $right_operand) = self::normalizeArgs($left_operand, $right_operand);

        if (null === $scale) {
            return (float)bcadd($left_operand, $right_operand);
        }

        return (float)bcadd($left_operand, $right_operand, $scale);
    }

    /**
     * @param mixed    $left_operand
     * @param mixed    $right_operand
     * @param int|null $scale
     *
     * @return float
     */
    public static function sub($left_operand, $right_operand, $scale = null)
    {
        list($left_operand, $right_operand) = self::normalizeArgs($left_operand, $right_operand);

        if (null === $scale) {
            return (float)bcsub($left_operand, $right_operand);
        }

        return (float)bcsub($left_operand, $right_operand, $scale);
    }

    /**
     * @param mixed    $left_operand
     * @param mixed    $right_operand
     * @param int|null $scale
     *
     * @return float
     */
    public static function mul($left_operand, $right_operand, $scale = null)
    {
        list($left_operand, $right_operand) = self::normalizeArgs($left_operand, $right_operand);

        if (null === $scale) {
            return (float)bcmul($left_operand, $right_operand);
        }

        return (float)bcmul($left_operand, $right_operand, $scale);
    }

    /**
     * @param mixed    $left_operand
     * @param mixed    $right_operand
     * @param int|null $scale
     *
     * @return float
     */
    public static function div($left_operand, $right_operand, $scale = null)
    {
        list($left_operand, $right_operand) = self::normalizeArgs($left_operand, $right_operand);

        if (null === $scale) {
            return (float)bcdiv($left_operand, $right_operand);
        }

        return (float)bcdiv($left_operand, $right_operand, $scale);
    }

    /**
     * @param mixed    $left_operand
     * @param mixed    $right_operand
     * @param int|null $scale
     *
     * @return int
     */
    public static function comp($left_operand, $right_operand, $scale = null)
    {
        list($left_operand, $right_operand) = self::normalizeArgs($left_operand, $right_operand);

        if (null === $scale) {
            return (int)bccomp($left_operand, $right_operand);
        }

        return (int)bccomp($left_operand, $right_operand, $scale);
    }
}
