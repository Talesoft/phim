<?php

namespace Phim\Geometry;

use Phim\GeometryBase;
use Phim\Point\PointDataInterface;
use Phim\PointInterface;
use Phim\Size;
use Phim\SizeInterface;

class Rectangle implements RectangleInterface
{
    use RectangleTrait;
        
    public function __construct($x, $y, $width, $height)
    {

        $this->setX($x);
        $this->setY($y);
        $this->setWidth($width);
        $this->setHeight($height);
    }
}