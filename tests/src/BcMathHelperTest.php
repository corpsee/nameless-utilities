<?php

namespace Nameless\Utilities\Tests;

use Nameless\Utilities\BcMathHelper;
use PHPUnit\Framework\TestCase;

class BcMathHelperTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        bcscale(2);
    }

    /**
     * @return array
     */
    public function addDataProvider()
    {
        return [
            [0.8, 0.7, 0.1, 1],
            [-0.88, -0.77, -0.11, 2],
            [-0.66, -0.77, 0.11, 2],
            [0.62, '0.51', '0.11', null],
            [0.62, '0.512', '0.111', null],
            [0.0000006, '0,000 0005', '0,000 0001', 7],
            [0.0000006, '0.0000005', '0.0000001', 7],
            [-0.0000006, '-0.0000005', '-0.0000001', 7],
            [0.0000006, '5.0E-7', '1.0E-7', 7],
            [-0.0000006, '-5.0E-7', '-1.0E-7', 7],
            [0.0000006, 0.0000005, '1.0E-7', 7],
            [6.0, 5, 1, 0],
            [6.0, 5, '1', 1],
            [6.00, 5, '1', 2],
        ];
    }

    /**
     * @dataProvider addDataProvider
     *
     * @param float $expected
     * @param mixed $leftOperand
     * @param mixed $rightOperand
     * @param int   $scale
     */
    public function testAdd($expected, $leftOperand, $rightOperand, $scale)
    {
        self::assertTrue(
            ($expected === BcMathHelper::add($leftOperand, $rightOperand, $scale))
        );
    }

    /**
     * @return array
     */
    public function subDataProvider()
    {
        return [
            [0.6, 0.7, 0.1, 1],
            [-0.66, -0.77, -0.11, 2],
            [-0.88, -0.77, 0.11, 2],
            [0.41, '0.52', '0.11', null],
            [0.41, '0.522', '0.111', null],
            [0.0000004, '0.0000005', '0,000 0001', 7],
            [0.0000004, '0.0000005', '0.0000001', 7],
            [-0.0000004, '-0.0000005', '-0.0000001', 7],
            [0.0000004, '5.0E-7', '1.0E-7', 7],
            [-0.0000004, '-5.0E-7', '-1.0E-7', 7],
            [0.0000004, 0.0000005, '1.0E-7', 7],
            [4.0, 5, 1, 0],
            [4.0, 5, '1', 1],
            [4.00, 5, '1', 2],
        ];
    }

    /**
     * @dataProvider subDataProvider
     *
     * @param float $expected
     * @param mixed $leftOperand
     * @param mixed $rightOperand
     * @param int   $scale
     */
    public function testSub($expected, $leftOperand, $rightOperand, $scale)
    {
        self::assertTrue(
            ($expected === BcMathHelper::sub($leftOperand, $rightOperand, $scale))
        );
    }

    /**
     * @return array
     */
    public function mulDataProvider()
    {
        return [
            [0.14, 0.7, 0.2, 2],
            [0.142, -0.71, -0.2, 3],
            [-0.142, -0.71, 0.2, 3],
            [0.12, '0.6', '0.2', null],
            [0.00, '0.06', '0.02', null],
            [0.000000000012, '0.000006', '0,000 002', 12],
            [0.000000000012, '0.000006', '0.000002', 12],
            [-0.000000000012, '0.000006', '-0.000002', 12],
            [0.000000000012, '6.0E-6', '2.0E-6', 12],
            [-0.000000000012, '6.0E-6', '-2.0E-6', 12],
            [0.000000000012, 0.000006, '2.0E-6', 12],
            [10.0, 5, 2, 0],
            [10.0, 5, '2', 1],
            [10.00, 5, '2', 2],
        ];
    }

    /**
     * @dataProvider mulDataProvider
     *
     * @param float $expected
     * @param mixed $leftOperand
     * @param mixed $rightOperand
     * @param int   $scale
     */
    public function testMul($expected, $leftOperand, $rightOperand, $scale)
    {
        self::assertTrue(
            ($expected === BcMathHelper::mul($leftOperand, $rightOperand, $scale))
        );
    }

    /**
     * @return array
     */
    public function divDataProvider()
    {
        return [
            [3.85, 0.77, 0.2, 2],
            [3.811, -0.7622, -0.2, 3],
            [-3.811, -0.7622, 0.2, 3],
            [3.85, '0.77', '0.2', null],
            [3.81, '0.7622', '0.2', null],
            [3.811, '0,762 2', '0.2', 3],
            [3.811, '0.7622', '0.2', 3],
            [-3.811, '0.7622', '-0.2', 3],
            [3.0, '6.0E-6', '2.0E-6', 1],
            [-3.0, '6.0E-6', '-2.0E-6', 1],
            [3.0, 0.000006, '2.0E-6', 1],
            [2.5, 5, 2, 1],
            [2.5, 5, '2', 1],
            [1.666666666, 5, '3', 9],
        ];
    }

    /**
     * @dataProvider divDataProvider
     *
     * @param float $expected
     * @param mixed $leftOperand
     * @param mixed $rightOperand
     * @param int   $scale
     */
    public function testDiv($expected, $leftOperand, $rightOperand, $scale)
    {
        self::assertTrue(
            ($expected === BcMathHelper::div($leftOperand, $rightOperand, $scale))
        );
    }

    /**
     * @return array
     */
    public function compDataProvider()
    {
        return [
            [1, 0.77, 0.2, 2],
            [-1, -0.2, 0.007, 3],
            [0, 0.0000002, 0.0000002, 7],
            [1, '0.77', '0.2', null],
            [0, '-0.771', '-0.772', null],
            [-1, '2.0E-6', '6.0E-6', 7],
        ];
    }

    /**
     * @dataProvider compDataProvider
     *
     * @param float $expected
     * @param mixed $leftOperand
     * @param mixed $rightOperand
     * @param int   $scale
     */
    public function testComp($expected, $leftOperand, $rightOperand, $scale)
    {
        self::assertTrue(
            ($expected === BcMathHelper::comp($leftOperand, $rightOperand, $scale))
        );
    }
}
