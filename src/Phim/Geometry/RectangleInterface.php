<?php

namespace Phim\Geometry;

use Phim\GeometryInterface;
use Phim\Point\PointDataInterface;

interface RectangleInterface extends GeometryInterface
{

    public function getSize();
    public function withSize(PointDataInterface $size);
}