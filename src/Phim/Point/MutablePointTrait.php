<?php

namespace Phim\Point;

use Phim\PointTrait;
use Phim\Util\MathUtil;
use Phim\Util\PointUtil;

trait MutablePointTrait
{
    use PointTrait;
    
    public function immutate()
    {

        return new ImmutablePoint($this->x, $this->y);
    }

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

    public function set($x, $y = null)
    {
        
        $this->x = $x;
        $this->y = $y ?: $x;
        
        return $this;
    }

    public function setArray(array $xy)
    {

        list($x, $y) = PointUtil::parseArray($xy);

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

    public function add($x, $y = null)
    {

        $this->x += $x;
        $this->y += $y ?: $x;

        return $this;
    }

    public function addArray(array $xy)
    {

        list($x, $y) = PointUtil::parseArray($xy);

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

    public function subtract($x, $y = null)
    {

        $this->x -= $x;
        $this->y -= $y ?: $x;

        return $this;
    }

    public function subtractArray(array $xy)
    {

        list($x, $y) = PointUtil::parseArray($xy);

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

    public function divide($x, $y = null)
    {
        
        MathUtil::validateDivisor($x);
        
        if ($y)
            MathUtil::validateDivisor($y);

        $this->x /= $x;
        $this->y /= $y ?: $x;

        return $this;
    }

    public function divideArray(array $xy)
    {

        list($x, $y) = PointUtil::parseArray($xy);

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

    public function multiply($x, $y = null)
    {

        $this->x *= $x;
        $this->y *= $y ?: $x;

        return $this;
    }

    public function multiplyArray(array $xy)
    {

        list($x, $y) = PointUtil::parseArray($xy);

        if ($x)
            $this->x *= $x;

        if ($y)
            $this->y *= $y;

        return $this;
    }
}