<?php

namespace Phim\Point;

use Phim\PointTrait;
use Phim\Util\MathUtil;
use Phim\Util\PointUtil;

trait ImmutablePointTrait
{
    use PointDataTrait;

    public function mutate(callable $mutator)
    {

        $point = new MutablePoint($this->x, $this->y);
        $mutator($point);

        return $point->immutate();
    }

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

    public function with($x, $y = null)
    {

        $point = clone $this;
        $point->x = $x;
        $point->y = $y !== null ? $y : $x;
        return $point;
    }

    public function withArray(array $array)
    {

        list($x, $y) = PointUtil::parseArray($array);

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

    public function withAdded($x, $y = null)
    {
        
        return $this->with($this->x + $x, $this->y + ($y !== null ? $y : $x));
    }

    public function withAddedArray(array $array)
    {
        
        list($x, $y) = PointUtil::parseArray($array);
        
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

    public function withSubtracted($x, $y = null)
    {

        return $this->with($this->x - $x, $this->y - ($y !== null ? $y : $x));
    }

    public function withSubtractedArray(array $xy)
    {

        list($x, $y) = PointUtil::parseArray($xy);

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

    public function withDivided($x, $y = null)
    {

        MathUtil::validateDivisor($x);

        if ($y)
            MathUtil::validateDivisor($y);

        return $this->with($this->x / $x, $this->y / ($y !== null ? $y : $x));
    }

    public function withDividedArray(array $xy)
    {

        list($x, $y) = PointUtil::parseArray($xy);

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

    public function withMultiplied($x, $y = null)
    {

        return $this->with($this->x * $x, $this->y * ($y !== null ? $y : $x));
    }

    public function withMultipliedArray(array $xy)
    {

        list($x, $y) = PointUtil::parseArray($xy);

        $point = clone $this;
        if ($x)
            $point->withMultipliedX($x);

        if ($y)
            $point->withMultipliedY($y);

        return $point;
    }
}