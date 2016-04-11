<?php

namespace Phim\Point;

use Phim\PointInterface;

interface ImmutableInterface extends PointInterface
{

    public function withX($x);
    public function withY($y);
    public function withXy($x, $y = null);
    public function withXyArray(array $xy);

    public function withAddedX($x);
    public function withAddedY($y);
    public function withAddedXy($x, $y = null);
    public function withAddedXyArray(array $xy);

    public function withSubtractedX($x);
    public function withSubtractedY($y);
    public function withSubtractedXy($x, $y = null);
    public function withSubtractedXyArray(array $xy);

    public function withDividedX($x);
    public function withDividedY($y);
    public function withDividedXy($x, $y = null);
    public function withDividedXyArray(array $xy);

    public function withMultipliedX($x);
    public function withMultipliedY($y);
    public function withMultipliedXy($x, $y = null);
    public function withMultipliedXyArray(array $xy);
}