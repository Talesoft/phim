<?php

namespace Phim\Path;

use Phim\PointInterface;
use Phim\PointTrait;

trait AnchorTrait
{
    use PointTrait;

    private $controlPoints = [];

    public function getControlPoints()
    {

        return $this->controlPoints;
    }

    public function addControlPoint(PointInterface $point)
    {

        $this->controlPoints[] = $point;

        return $this;
    }

    public function removeControlPoint(PointInterface $point)
    {

        $this->controlPoints = array_filter($this->controlPoints, function (PointInterface $controlPoint) use ($point) {

            return $controlPoint === $point;
        });

        return $this;
    }
}