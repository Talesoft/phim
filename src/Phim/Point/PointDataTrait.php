<?php

namespace Phim\Point;

trait PointDataTrait
{

    protected $x = 0;
    protected $y = 0;

    public function getX()
    {

        return $this->x;
    }

    public function getY()
    {

        return $this->y;
    }

    public function getArray()
    {
        return [$this->x, $this->y];
    }
}