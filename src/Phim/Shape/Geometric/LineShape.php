<?php

namespace Phim\Shape\Geometric;

use Phim\Geometry\LineInterface;
use Phim\Shape\GeometricShapeBase;
use Phim\StyleInterface;

class LineShape extends GeometricShapeBase
{

    public function __construct(LineInterface $line, StyleInterface $style = null)
    {

        parent::__construct($line, $style);
    }
}