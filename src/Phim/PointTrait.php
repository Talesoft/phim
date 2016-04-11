<?php

namespace Phim;

trait PointTrait
{
    
    protected $x;
    protected $y;

    public function getX()
    {

        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }
    
    public function getXyArray()
    {
        
        return [$this->x, $this->y];
    }
}