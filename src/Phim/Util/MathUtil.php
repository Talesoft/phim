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

        while ($value > $base)
            $value -= $base;

        while ($value < 0)
            $value += $base;

        return $value;
    }

    public static function convertValue($value, $type, $base, $rotate = false)
    {

        if (!is_numeric($value)) {

            //sorted by probable occurence
            $checkUnits = [self::UNIT_PERCENT, self::UNIT_RADIANS, self::UNIT_PERMILLE];
            $len = mb_strlen($value);
            foreach ($checkUnits as $currentUnit) {

                $unitLen = mb_strlen($currentUnit);
                if ($len > $unitLen && mb_substr($value, -$unitLen) === $currentUnit) {

                    $value = floatval(mb_substr($value, 0, -$unitLen));
                    switch ($currentUnit) {
                        case self::UNIT_RADIANS:
                            $value = round($value * 180 / M_PI, 3, PHP_ROUND_HALF_UP);
                            break;
                        case self::UNIT_PERCENT:
                            $value = $base / 100 * $value;
                            break;
                        case self::UNIT_PERMILLE:
                            $value = $base / 1000 * $value;
                            break;
                    }

                    break;
                }
            }

            if (!is_numeric($value))
                throw new \InvalidArgumentException(
                    "Tried to convert value $value, but it's not any kind of numeric value and/or using an invalid unit"
                );
        }

        if ($rotate)
            $value = self::rotateValue($value, $base);

        switch ($type) {
            case 'int': return (int)round($value, 0, PHP_ROUND_HALF_UP);
            case 'float': break;
            default:

                throw new \InvalidArgumentException(
                    "Passed value type $type is not valid. Use 'float' or 'int'."
                );
        }

        return floatval($value);
    }
}