<?php

namespace Phim\Point;

use Phim\PointTrait;
use Phim\Util\MathUtil;
use Phim\Util\PointUtil;

trait MutableTrait
{
    use PointTrait;

    public function setX($x)
    {

        $this->x = $x;
        
        return $this;
    }

    public function setY($y)
    {

        $this->y = $y;
        
        return $this;
    }

    public function setXy($x, $y = null)
    {
        
        $this->x = $x;
        $this->y = $y ?: $x;
        
        return $this;
    }

    public function setXyArray(array $xy)
    {

        list($x, $y) = PointUtil::parseXyArray($xy);

        if ($x)
            $this->x = $x;

        if ($y)
            $this->y = $y;

        return $this;
    }

    public function addX($x)
    {

        $this->x += $x;

        return $this;
    }

    public function addY($y)
    {

        $this->y += $y;

        return $this;
    }

    public function addXy($x, $y = null)
    {

        $this->x += $x;
        $this->y += $y ?: $x;

        return $this;
    }

    public function addXyArray(array $xy)
    {

        list($x, $y) = PointUtil::parseXyArray($xy);

        if ($x)
            $this->x += $x;

        if ($y)
            $this->y += $y;

        return $this;
    }

    public function subtractX($x)
    {

        $this->x -= $x;

        return $this;
    }

    public function subtractY($y)
    {

        $this->y -= $y;

        return $this;
    }

    public function subtractXy($x, $y = null)
    {

        $this->x -= $x;
        $this->y -= $y ?: $x;

        return $this;
    }

    public function subtractXyArray(array $xy)
    {

        list($x, $y) = PointUtil::parseXyArray($xy);

        if ($x)
            $this->x -= $x;

        if ($y)
            $this->y -= $y;

        return $this;
    }

    public function divideX($x)
    {

        MathUtil::validateDivisor($x);
        
        $this->x /= $x;

        return $this;
    }

    public function divideY($y)
    {

        MathUtil::validateDivisor($y);
        
        $this->y /= $y;

        return $this;
    }

    public function divideXy($x, $y = null)
    {
        
        MathUtil::validateDivisor($x);
        
        if ($y)
            MathUtil::validateDivisor($y);

        $this->x /= $x;
        $this->y /= $y ?: $x;

        return $this;
    }

    public function divideXyArray(array $xy)
    {

        list($x, $y) = PointUtil::parseXyArray($xy);

        if ($x) {

            MathUtil::validateDivisor($x);
            $this->x /= $x;
        }

        if ($y) {

            MathUtil::validateDivisor($y);
            $this->y /= $y;
        }

        return $this;
    }

    public function multiplyX($x)
    {

        $this->x *= $x;

        return $this;
    }

    public function multiplyY($y)
    {

        $this->y *= $y;

        return $this;
    }

    public function multiplyXy($x, $y = null)
    {

        $this->x *= $x;
        $this->y *= $y ?: $x;

        return $this;
    }

    public function multiplyXyArray(array $xy)
    {

        list($x, $y) = PointUtil::parseXyArray($xy);

        if ($x)
            $this->x *= $x;

        if ($y)
            $this->y *= $y;

        return $this;
    }
}