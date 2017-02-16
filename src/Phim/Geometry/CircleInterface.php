<?php

namespace Phim\Geometry;

use Phim\GeometryInterface;
use Phim\Point\PointDataInterface;

interface CircleInterface extends GeometryInterface
{

    public function getRadius();
    public function setRadius($radius);
}