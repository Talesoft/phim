<?php

namespace Phim\Util;

class PointUtil
{

    private function __construct() {}

    public static function parseXyArray(array $xy)
    {

        $x = isset($xy['x']);
        $y = isset($xy['y']);

        if ($x || $y)
            return [$x ? $xy['x'] : null, $y ? $xy['y'] : null];

        return array_slice(array_pad(array_values($xy), 2, null), 0, 2);
    }
}