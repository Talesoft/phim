<?php

namespace Phim;

class Point implements PointInterface
{
    use PointTrait;

    public function __construct($x, $y)
    {

        $this->setX($x);
        $this->setY($y);
    }

    public static function fromPoint(PointInterface $point)
    {

        return new Point($point->getX(), $point->getY());
    }
}