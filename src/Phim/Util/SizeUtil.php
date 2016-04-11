<?php

namespace Phim\Util;

class SizeUtil
{

    private function __construct() {}

    public static function parseArray(array $xy)
    {

        $x = isset($xy['width']);
        $y = isset($xy['height']);

        if ($x || $y)
            return [$x ? $xy['width'] : null, $y ? $xy['height'] : null];

        return array_slice(array_pad(array_values($xy), 2, null), 0, 2);
    }
}