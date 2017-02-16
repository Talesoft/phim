<?php

namespace Phim\Shape\Geometric;

use Phim\Geometry\ArcInterface;
use Phim\Shape\GeometricShapeBase;
use Phim\StyleInterface;

class ArcShape extends GeometricShapeBase
{

    public function __construct(ArcInterface $arc, StyleInterface $style = null)
    {

        parent::__construct($arc, $style);
    }
}