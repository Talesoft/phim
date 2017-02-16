<?php

namespace Phim\Geometry;

use Phim\Path;

class Circle implements CircleInterface
{
    use CircleTrait;

    public function __construct($x, $y, $radius)
    {

        $this->setX($x);
        $this->setY($y);
        $this->setRadius($radius);
    }

    public function toPath()
    {

        //TODO: Implement circle path creation
        return new Path;
    }
}