<?php

namespace Phim\Shape\Geometric;

use Phim\Geometry\EllipseInterface;
use Phim\Shape\GeometricShapeBase;
use Phim\StyleInterface;

class EllipseShape extends GeometricShapeBase
{

    public function __construct(EllipseInterface $ellipse, StyleInterface $style = null)
    {

        parent::__construct($ellipse, $style);
    }
}