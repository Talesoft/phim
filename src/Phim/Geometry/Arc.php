<?php

namespace Phim\Geometry;

use Phim\Path;

class Arc implements ArcInterface
{
    use ArcTrait;

    public function __construct($x, $y, $radiusX, $radiusY, $startAngle, $endAngle)
    {

        $this->setX($x);
        $this->setY($y);
        $this->setRadiusX($radiusX);
        $this->setRadiusY($radiusY);
        $this->setStartAngle($startAngle);
        $this->setEndAngle($endAngle);
    }

    public function toPath()
    {

        //TODO: Implement arc path creation
        return new Path;
    }
}