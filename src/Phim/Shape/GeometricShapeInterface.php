<?php

namespace Phim\Shape;

use Phim\GeometryInterface;
use Phim\ShapeInterface;

interface GeometricShapeInterface extends ShapeInterface
{

    public function getGeometry();
    public function setGeometry(GeometryInterface $geometry);
    public function updatePath();
}