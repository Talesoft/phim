<?php

namespace Phim\Point;

use Phim\PointTrait;
use Phim\Util\MathUtil;
use Phim\Util\PointUtil;

trait ImmutableTrait
{
    use PointTrait;

    public function withX($x)
    {

        $point = clone $this;
        $point->x = $x;
        return $point;
    }

    public function withY($y)
    {

        $point = clone $this;
        $point->y = $y;
        return $point;
    }

    public function withXy($x, $y = null)
    {

        $point = clone $this;
        $point->x = $x;
        $point->y = $y ?: $x;
        return $point;
    }

    public function withXyArray(array $xy)
    {

        list($x, $y) = PointUtil::parseXyArray($xy);

        $point = clone $this;
        if ($x)
            $point->x = $x;

        if ($y)
            $point->y = $y;

        return $point;
    }

    public function withAddedX($x)
    {
        
        return $this->withX($this->x + $x);
    }

    public function withAddedY($y)
    {
        
        return $this->withY($this->y + $y);
    }

    public function withAddedXy($x, $y = null)
    {
        
        return $this->withXy($this->x + $x, $this->y + ($y ?: $x));
    }

    public function withAddedXyArray(array $xy)
    {
        
        list($x, $y) = PointUtil::parseXyArray($xy);
        
        $point = clone $this;
        if ($x)
            $point->withAddedX($x);
        
        if ($y)
            $point->withAddedY($y);
        
        return $point;
    }

    public function withSubtractedX($x)
    {

        return $this->withX($this->x - $x);
    }

    public function withSubtractedY($y)
    {

        return $this->withY($this->y - $y);
    }

    public function withSubtractedXy($x, $y = null)
    {

        return $this->withXy($this->x - $x, $this->y - ($y ?: $x));
    }

    public function withSubtractedXyArray(array $xy)
    {

        list($x, $y) = PointUtil::parseXyArray($xy);

        $point = clone $this;
        if ($x)
            $point->withSubtractedX($x);

        if ($y)
            $point->withSubtractedY($y);

        return $point;
    }

    public function withDividedX($x)
    {
        
        MathUtil::validateDivisor($x);

        return $this->withX($this->x / $x);
    }

    public function withDividedY($y)
    {

        MathUtil::validateDivisor($y);

        return $this->withY($this->y / $y);
    }

    public function withDividedXy($x, $y = null)
    {

        MathUtil::validateDivisor($x);

        if ($y)
            MathUtil::validateDivisor($y);

        return $this->withXy($this->x / $x, $this->y / ($y ?: $x));
    }

    public function withDividedXyArray(array $xy)
    {

        list($x, $y) = PointUtil::parseXyArray($xy);

        $point = clone $this;
        if ($x) {

            MathUtil::validateDivisor($x);
            $point->withDividedX($x);
        }

        if ($y) {
            
            MathUtil::validateDivisor($y);
            $point->withDividedY($y);
        }

        return $point;
    }

    public function withMultipliedX($x)
    {

        return $this->withX($this->x * $x);
    }

    public function withMultipliedY($y)
    {

        return $this->withY($this->y * $y);
    }

    public function withMultipliedXy($x, $y = null)
    {

        return $this->withXy($this->x * $x, $this->y * ($y ?: $x));
    }

    public function withMultipliedXyArray(array $xy)
    {

        list($x, $y) = PointUtil::parseXyArray($xy);

        $point = clone $this;
        if ($x)
            $point->withMultipliedX($x);

        if ($y)
            $point->withMultipliedY($y);

        return $point;
    }
}