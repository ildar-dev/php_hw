<?php

/**
 * File Doc Comment
 *
 * PHP version 7
 *
 * @category Ildar_Davletyarov_Home_Work
 * @package  Ildar_Davletyarov_Home_Work
 * @author   Ildar Davletyarov <ildardaf@gmail.com>
 * @license  does not exist
 * @link     vk.com/plosko
 */

namespace tests;

use app\ComplexNumber;
use PHPUnit\Framework\TestCase;

$sep = DIRECTORY_SEPARATOR;
require_once __DIR__ . '/..' . $sep . "app" . $sep . "ComplexNumber.php";


/**
 * Test for Complex number
 *
 * Test for general functions and arguments
 *
 * @category Ildar_Davletyarov_Home_Work
 * @package  Ildar_Davletyarov_Home_Work
 * @author   Ildar Davletyarov <ildardaf@gmail.com>
 * @license  without licence
 * @link     vk.com/plosko
 */
class ComplexNumberTest extends TestCase
{
    /**
     * Test for difference
     *
     * @param float $a1 real part of complex number
     * @param float $b1 imaginary part of complex number
     * @param float $a2 real part of complex number
     * @param float $b2 imaginary part of complex number
     *
     * @dataProvider dataSetWithoutExpected
     *
     * @return void
     */
    public function testAdd(
        float $a1,
        float $b1,
        float $a2,
        float $b2
    ): void {
        $first = new ComplexNumber($a1, $b1);
        $second = new ComplexNumber($a2, $b2);
        $result = $first->add($second);
        $this->assertEquals($a1 + $a2, $result->realPart);
        $this->assertEquals($b1 + $b2, $result->imaginaryPart);
    }

    /**
     * Test for difference
     *
     * @param float $a1 real part of complex number
     * @param float $b1 imaginary part of complex number
     * @param float $a2 real part of complex number
     * @param float $b2 imaginary part of complex number
     *
     * @dataProvider dataSetWithoutExpected
     *
     * @return void
     */
    public function testSub(
        float $a1,
        float $b1,
        float $a2,
        float $b2
    ): void {
        $first = new ComplexNumber($a1, $b1);
        $second = new ComplexNumber($a2, $b2);
        $result = $first->sub($second);
        $this->assertEquals($a1 - $a2, $result->realPart);
        $this->assertEquals($b1 - $b2, $result->imaginaryPart);
    }

    /**
     * Test for multiply
     *
     * @param float $a1        real part of complex number
     * @param float $b1        imaginary part of complex number
     * @param float $a2        real part of complex number
     * @param float $b2        imaginary part of complex number
     * @param float $expectedA expected real part
     * @param float $expectedB expected imaginary part
     *
     * @dataProvider dataWithExpectedMult
     *
     * @return void
     */
    public function testMult(
        float $a1,
        float $b1,
        float $a2,
        float $b2,
        float $expectedA,
        float $expectedB
    ): void {
        $first = new ComplexNumber($a1, $b1);
        $second = new ComplexNumber($a2, $b2);
        $result = $first->mult($second);
        $this->assertEquals($expectedA, $result->realPart);
        $this->assertEquals($expectedB, $result->imaginaryPart);
    }

    /**
     * Test for divide numbers
     *
     * @param float $a1        real part of complex number
     * @param float $b1        imaginary part of complex number
     * @param float $a2        real part of complex number
     * @param float $b2        imaginary part of complex number
     * @param float $expectedA expected real part
     * @param float $expectedB expected imaginary part
     *
     * @dataProvider dataWithExpectedDiv
     *
     * @return void
     */
    public function testDiv(
        float $a1,
        float $b1,
        float $a2,
        float $b2,
        float $expectedA,
        float $expectedB
    ): void {
        $first = new ComplexNumber($a1, $b1);
        $second = new ComplexNumber($a2, $b2);
        $result = $first->div($second);
        $this->assertEquals($expectedA, $result->realPart);
        $this->assertEquals($expectedB, $result->imaginaryPart);
    }

    /**
     * Test for absolute value
     *
     * @param float $a1       real part of complex number
     * @param float $b1       imaginary part of complex number
     * @param float $expected expected value
     *
     * @dataProvider dataWithExpectedAbs
     *
     * @return void
     */
    public function testAbs(float $a1, float $b1, float $expected): void
    {
        $first = new ComplexNumber($a1, $b1);
        $result = $first->abs();
        $this->assertEquals($result, $expected);
    }

    /**
     * Test for absolute number
     *
     * @return void
     */
    public function testAbsWithZeroPart(): void
    {
        for ($i = -10; $i < 10; $i += 0.01) {
            $numberWithoutImaginary = new ComplexNumber($i, 0);
            $this->assertEquals(abs($i), $numberWithoutImaginary->abs());
            $numberWithoutReal = new ComplexNumber(0, $i);
            $this->assertEquals(abs($i), $numberWithoutReal->abs());
        }
    }

    /**
     * Test for division by zero
     *
     * @expectedException \InvalidArgumentException
     * не проходит тест, хотя сам ожидает данное исключение
     *
     * @return void
     */
    public function testExceptionDivisionByZero(): void
    {
        $first = new ComplexNumber(0, 0);
        $second = new ComplexNumber(0, 0);
        $first->div($second);
    }

    /**
     * Test for NAN arguments
     *
     * @return void
     */
    public function testNan(): void
    {
        $first = new ComplexNumber(NAN, NAN);
        $second = new ComplexNumber(NAN, NAN);

        $this->assertNan($first->abs());

        $this->assertNan($first->add($second)->imaginaryPart);
        $this->assertNan($first->add($second)->realPart);

        $this->assertNan($first->sub($second)->imaginaryPart);
        $this->assertNan($first->sub($second)->realPart);

        $this->assertNan($first->div($second)->imaginaryPart);
        $this->assertNan($first->div($second)->realPart);

        $this->assertNan($first->mult($second)->imaginaryPart);
        $this->assertNan($first->mult($second)->realPart);
    }

    /**
     * Test for override __toString
     *
     * @param float $a1 real part of complex number
     * @param float $b1 imaginary part of complex number
     *
     * @dataProvider dataSetWithoutExpected
     *
     * @return void
     */
    public function testToString(float $a1, float $b1): void
    {
        $first = new ComplexNumber($a1, $b1);
        $this->assertStringContainsString($a1, $first);
        $this->assertStringContainsString($b1, $first);
        $this->assertStringContainsStringIgnoringCase("i", $first);
    }

    /**
     * Data provider for testAdd, testSub
     *
     * @return array
     */
    public function dataSetWithoutExpected(): array
    {
        return [
            [0, 0, 0, 0],
            [10, 10, 20, -20.0],
            [1, 2, 3, 4]
        ];
    }

    /**
     * Data provider for testMult
     *
     * @return array
     */
    public function dataWithExpectedMult(): array
    {
        return [
            [0, 0, 0, 0, 0, 0],
            [1, 2, 3, 4, -5, 10],
            [1.5, 2.5, 3.5, 4.5, -6, 15.5]
        ];
    }

    /**
     * Data provider for testDiv
     *
     * @return array
     */
    public function dataWithExpectedDiv(): array
    {
        return [
            [1, 2, 3, 4, 0.44, 0.08],
            [1.5, 2.5, 3.5, 4.5, 33 / 65, 4 / 65]
        ];
    }

    /**
     * Data provider for testAbs
     *
     * @return array
     */
    public function dataWithExpectedAbs(): array
    {
        return [
            [0, 0, 0],
            [3, 4, 5],
            [-10, -10, sqrt(200)]
        ];
    }
}