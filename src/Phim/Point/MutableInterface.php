<?php

namespace Phim\Point;

use Phim\PointInterface;

interface MutableInterface extends PointInterface
{

    public function setX($x);
    public function setY($y);
    public function setXy($x, $y = null);
    public function setXyArray(array $xy);

    public function addX($x);
    public function addY($y);
    public function addXy($x, $y = null);
    public function addXyArray(array $xy);

    public function subtractX($x);
    public function subtractY($y);
    public function subtractXy($x, $y = null);
    public function subtractXyArray(array $xy);

    public function divideX($x);
    public function divideY($y);
    public function divideXy($x, $y = null);
    public function divideXyArray(array $xy);

    public function multiplyX($x);
    public function multiplyY($y);
    public function multiplyXy($x, $y = null);
    public function multiplyXyArray(array $xy);
}