<?php

namespace Phim\Util;

use Phim\Exception\Runtime\ZeroDivisionException;

class MathUtil
{

    const UNIT_FIXED = null;
    const UNIT_PERCENT = '%';
    const UNIT_PERMILLE = '‰';
    const UNIT_RADIANS = 'rad';

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

    public static function convertValue($value, $type, $base, $rotate = false)
    {

        if (!is_numeric($value)) {

            //sorted by probable occurence
            $checkUnits = [self::UNIT_PERCENT, self::UNIT_RADIANS, self::UNIT_PERMILLE];
            foreach ($checkUnits as $currentUnit => $unitBase) {

                $len = mb_strlen($currentUnit);
                if (mb_strpos($value, $currentUnit, -$len) !== false) {

                    $value = floatval(mb_substr($value, 0, -$len));

                    switch ($currentUnit) {
                        case self::UNIT_RADIANS:

                            $value = $value * (M_PI / 180);
                            break;
                        case self::UNIT_PERCENT:
                            $value = 100 / $base * $value;
                            break;
                        case self::UNIT_PERMILLE:
                            $value = 1000 / $base * $value;
                            break;
                    }
                    continue;
                }
            }

            if (!is_numeric($value))
                throw new \InvalidArgumentException(
                    "Tried to convert value $value, but it's not any kind of numeric value and/or using an invalid unit"
                );
        }

        switch ($type) {
            case 'int': return round($value, 0, PHP_ROUND_HALF_UP);
        }

    }
}