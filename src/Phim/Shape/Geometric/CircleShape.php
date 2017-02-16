<?php

namespace Phim\Shape\Geometric;

use Phim\Geometry\ArcInterface;
use Phim\Geometry\CircleInterface;
use Phim\Shape\GeometricShapeBase;
use Phim\StyleInterface;

class CircleShape extends GeometricShapeBase
{

    public function __construct(CircleInterface $circle, StyleInterface $style = null)
    {

        parent::__construct($circle, $style);
    }
}