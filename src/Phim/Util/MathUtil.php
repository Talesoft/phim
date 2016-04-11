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
}