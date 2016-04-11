<?php

namespace Phim\Point;

use Phim\Mutation\ImmutableInterface;

interface ImmutablePointInterface extends PointDataInterface, ImmutableInterface
{
    
    public function withX($x);
    public function withY($y);
    public function with($x, $y = null);
    public function withArray(array $array);

    public function withAddedX($x);
    public function withAddedY($y);
    public function withAdded($x, $y = null);
    public function withAddedArray(array $array);

    public function withSubtractedX($x);
    public function withSubtractedY($y);
    public function withSubtracted($x, $y = null);
    public function withSubtractedArray(array $array);

    public function withDividedX($x);
    public function withDividedY($y);
    public function withDivided($x, $y = null);
    public function withDividedArray(array $array);

    public function withMultipliedX($x);
    public function withMultipliedY($y);
    public function withMultiplied($x, $y = null);
    public function withMultipliedArray(array $array);
}