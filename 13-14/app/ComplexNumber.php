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
namespace app;

/**
 *  Complex number
 *
 * Complex number with general functions
 *
 * @category Ildar_Davletyarov_Home_Work
 * @package  Ildar_Davletyarov_Home_Work
 * @author   Ildar Davletyarov <ildardaf@gmail.com>
 * @license  without licence
 * @link     vk.com/plosko
 */
class ComplexNumber
{
    public $imaginaryPart;
    public $realPart;

    /**
     * ComplexNumber constructor.
     *
     * @param float $realPart      real part of complex number (a)
     * @param float $imaginaryPart imaginary part of complex number (b)
     */
    public function __construct(float $realPart, float $imaginaryPart)
    {
        $this->imaginaryPart = $imaginaryPart;
        $this->realPart = $realPart;
    }

    /**
     * Override toString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->realPart . " " . $this->imaginaryPart . "i";
    }

    /**
     * Return sum of self and second number
     *
     * @param ComplexNumber $number second term
     *
     * @return ComplexNumber
     */
    public function add(ComplexNumber $number): ComplexNumber
    {
        return new ComplexNumber(
            $this->realPart + $number->realPart,
            $this->imaginaryPart + $number->imaginaryPart
        );
    }

    /**
     * Return the difference between self and second numbers
     *
     * @param ComplexNumber $number subtrahend

     * @return ComplexNumber
     */
    public function sub(ComplexNumber $number): ComplexNumber
    {
        return new ComplexNumber(
            $this->realPart - $number->realPart,
            $this->imaginaryPart - $number->imaginaryPart
        );
    }

    /**
     * Return the multiply of a self number by the second
     *
     * @param ComplexNumber $number second factor
     *
     * @return ComplexNumber
     */
    public function mult(ComplexNumber $number): ComplexNumber
    {
        //z=z1⋅z2=(a1a2−b1b2)+(a1b2+b1a2)i
        $a1 = $this->realPart;
        $a2 = $number->realPart;
        $b1 = $this->imaginaryPart;
        $b2 = $number->imaginaryPart;
        return new ComplexNumber(
            $a1 * $a2 - $b1 * $b2,
            $a1 * $b2 + $b1 * $a2
        );
    }

    /**
     * Return divided self by second number
     *
     * @param ComplexNumber $number divider
     *
     * @return ComplexNumber
     */
    public function div(ComplexNumber $number): ComplexNumber
    {
        //z=z1/z2=(a1a2+b1b2)/(a22+b22)+((a2b1−a1b2)/(a22+b22))i
        $a1 = $this->realPart;
        $a2 = $number->realPart;
        $b1 = $this->imaginaryPart;
        $b2 = $number->imaginaryPart;
        if (abs($a2 * $a2 + $b2 * $b2 - 0) < 1E-10) {
            throw new \InvalidArgumentException('Division by zero');
        } else {
            return new ComplexNumber(
                ($a1 * $a2 + $b1 * $b2) / ($a2 * $a2 + $b2 * $b2),
                ($a2 * $b1 - $a1 * $b2) / ($a2 * $a2 + $b2 * $b2)
            );
        }
    }

    /**
     * Return module of the number
     *
     * @return float
     */
    public function abs(): float
    {
        $a1 = $this->realPart;
        $b1 = $this->imaginaryPart;
        return sqrt($a1 * $a1 + $b1 * $b1);
    }
}