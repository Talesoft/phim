<?php

namespace Phim\Geometry;

use Phim\GeometryInterface;
use Phim\Point\PointDataInterface;

interface EllipseInterface extends GeometryInterface
{

    public function getRadiusX();
    public function setRadiusX($radiusX);
    public function getRadiusY();
    public function setRadiusY($radiusY);
}