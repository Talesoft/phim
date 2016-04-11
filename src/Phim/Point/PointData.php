<?php

namespace Phim\Point;

class PointData implements PointDataInterface
{
    use PointDataTrait;

    public function __construct($x, $y)
    {

        $this->x = $x;
        $this->y = $y;
    }
}