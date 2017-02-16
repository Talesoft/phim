<?php

namespace Phim\Geometry;

use Phim\GeometryTrait;
use Phim\Point;
use Phim\PointInterface;

trait LineTrait
{
    use GeometryTrait;

    private $toX = 0;
    private $toY = 0;

    /**
     * @return int
     */
    public function getToX()
    {

        return $this->toX;
    }

    /**
     * @param int $toX
     *
     * @return $this
     */
    public function setToX($toX)
    {

        $this->toX = $toX;

        return $this;
    }

    /**
     * @return int
     */
    public function getToY()
    {

        return $this->toY;
    }

    /**
     * @param int $toY
     *
     * @return $this
     */
    public function setToY($toY)
    {

        $this->toY = $toY;

        return $this;
    }
    
    public function getTo()
    {
        
        return new Point($this->toX, $this->toY);
    }

    public function setTo(PointInterface $point)
    {

        $this->toX = $point->getX();
        $this->toY = $point->getY();

        return $this;
    }

    public function getDistance()
    {

        return sqrt(pow($this->toX - $this->getX(), 2) + pow($this->toY - $this->getY(), 2));
    }
}