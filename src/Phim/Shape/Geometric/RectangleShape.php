<?php

namespace Phim\Shape\Geometric;

use Phim\Geometry\RectangleInterface;
use Phim\Shape\GeometricShapeBase;
use Phim\StyleInterface;

class RectangleShape extends GeometricShapeBase
{

    public function __construct(RectangleInterface $rectangle, StyleInterface $style = null)
    {

        parent::__construct($rectangle, $style);
    }
}