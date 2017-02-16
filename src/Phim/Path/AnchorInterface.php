<?php

namespace Phim\Path;

use Phim\PointInterface;

interface AnchorInterface extends PointInterface
{

    public function getControlPoints();
    public function addControlPoint(PointInterface $controlPoint);
    public function removeControlPoint(PointInterface $controlPoint);
}