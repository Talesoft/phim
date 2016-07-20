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

    public static function capInt(int $value, int $max = 1, int $min = 0): int
    {

        return min($max, max($value, $min));
    }

    public static function capFloat(float $value, float $max = 1.0, float $min = 0.0): float
    {

        return min($max, max($value, $min));
    }

    public static function rotateInt(int $value, int $base, int $min = 0): int
    {

        if ($value >= $base)
            return $value - $base;

        if ($value < $min)
            return $value + $base;

        return $value;
    }

    public static function rotateFloat(float $value, float $base, float $min = 0.0): float
    {

        if ($value > $base)
            return $value - $base;

        if ($value < $min)
            return $value + $base;

        return $value;
    }
}