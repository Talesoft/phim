<?php

namespace Phim\Geometry;

use Phim\GeometryInterface;

interface ArcInterface extends GeometryInterface
{

    public function getRadiusX();
    public function setRadiusX($radiusX);
    public function getRadiusY();
    public function setRadiusY($radiusY);
    public function getStartAngle();
    public function setStartAngle($startAngle);
    public function getEndAngle();
    public function setEndAngle($endAngle);
}