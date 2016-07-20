<?php

namespace Phim\Util;

use Phim\Exception\Runtime\ZeroDivisionException;

class MathUtil
{

    private function __construct() {}

    public static function validateDivisor($divisor)
    {

        if ($divisor === 0)
            throw new ZeroDivisionException(
                "Failed to divide: You can't divide by zero"
            );
    }

    public static function capValue($value, $min, $max) {

        return max($min, min($value, $max));
    }

    public static function rotateValue($value, $base)
    {

        if ($value > $base)
            $value -= $base;

        if ($value < 0)
            $value = $base + $value;

        return $value;
    }
}