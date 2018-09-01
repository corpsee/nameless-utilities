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
 * Class BcMathHelper
 *
 * @author Corpsee <poisoncorpsee@gmail.com>
 */
class BcMathHelper
{
    /**
     * @param mixed $leftOperand
     * @param mixed $rightOperand
     *
     * @return array
     */
    protected static function normalizeArgs($leftOperand, $rightOperand): array
    {
        $leftOperand  = self::normalizeNumber($leftOperand);
        $rightOperand = self::normalizeNumber($rightOperand);

        return [
            $leftOperand,
            $rightOperand,
        ];
    }

    /**
     * @param string|float $number
     *
     * @return string
     */
    public static function normalizeNumber($number): string
    {
        $number = str_replace([',', ' '], ['.', ''], (string)$number);

        if (
            (($e = strrchr($number, 'e')) !== false) ||
            (($e = strrchr($number, 'E')) !== false)
        ) {
            $number = number_format((float)$number, -intval(substr($e, 1)));
        }

        return $number;
    }

    /**
     * @param mixed    $leftOperand
     * @param mixed    $rightOperand
     * @param int|null $scale
     *
     * @return float
     */
    public static function add($leftOperand, $rightOperand, ?int $scale = null): float
    {
        list($leftOperand, $rightOperand) = self::normalizeArgs($leftOperand, $rightOperand);

        if (null === $scale) {
            return (float)bcadd($leftOperand, $rightOperand);
        }

        return (float)bcadd($leftOperand, $rightOperand, $scale);
    }

    /**
     * @param mixed    $leftOperand
     * @param mixed    $rightOperand
     * @param int|null $scale
     *
     * @return float
     */
    public static function sub($leftOperand, $rightOperand, ?int $scale = null): float
    {
        list($leftOperand, $rightOperand) = self::normalizeArgs($leftOperand, $rightOperand);

        if (null === $scale) {
            return (float)bcsub($leftOperand, $rightOperand);
        }

        return (float)bcsub($leftOperand, $rightOperand, $scale);
    }

    /**
     * @param mixed    $leftOperand
     * @param mixed    $rightOperand
     * @param int|null $scale
     *
     * @return float
     */
    public static function mul($leftOperand, $rightOperand, ?int $scale = null): float
    {
        list($leftOperand, $rightOperand) = self::normalizeArgs($leftOperand, $rightOperand);

        if (null === $scale) {
            return (float)bcmul($leftOperand, $rightOperand);
        }

        return (float)bcmul($leftOperand, $rightOperand, $scale);
    }

    /**
     * @param mixed    $leftOperand
     * @param mixed    $rightOperand
     * @param int|null $scale
     *
     * @return float
     */
    public static function div($leftOperand, $rightOperand, ?int $scale = null): float
    {
        list($leftOperand, $rightOperand) = self::normalizeArgs($leftOperand, $rightOperand);

        if (null === $scale) {
            return (float)bcdiv($leftOperand, $rightOperand);
        }

        return (float)bcdiv($leftOperand, $rightOperand, $scale);
    }

    /**
     * @param mixed    $leftOperand
     * @param mixed    $rightOperand
     * @param int|null $scale
     *
     * @return int
     */
    public static function comp($leftOperand, $rightOperand, ?int $scale = null): int
    {
        list($leftOperand, $rightOperand) = self::normalizeArgs($leftOperand, $rightOperand);

        if (null === $scale) {
            return (int)bccomp($leftOperand, $rightOperand);
        }

        return (int)bccomp($leftOperand, $rightOperand, $scale);
    }
}
