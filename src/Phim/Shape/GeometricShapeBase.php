<?php

namespace Phim\Shape;

use Phim\GeometryInterface;
use Phim\StyleInterface;

abstract class GeometricShapeBase implements GeometricShapeInterface
{
    use GeometricShapeTrait;

    public function __construct(GeometryInterface $geometry, StyleInterface $style = null)
    {

        $this->setGeometry($geometry);
        $this->updatePath();
        $this->setStyle($style);
    }
}