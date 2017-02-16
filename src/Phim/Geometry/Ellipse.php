<?php

namespace Phim\Geometry;

use Phim\Path;

class Ellipse implements EllipseInterface
{
    use EllipseTrait;

    public function __construct($x, $y, $radiusX, $radiusY)
    {

        $this->setX($x);
        $this->setY($y);
        $this->setRadiusX($radiusX);
        $this->setRadiusY($radiusY);
    }

    public function toPath()
    {

        //TODO: Implement ellipse path creation
        return new Path;
    }
}