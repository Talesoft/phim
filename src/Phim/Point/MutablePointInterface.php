<?php

namespace Phim\Point;

use Phim\Mutation\MutableInterface;

interface MutablePointInterface extends PointDataInterface, MutableInterface
{

    public function setX($x);
    public function setY($y);
    public function set($x, $y = null);
    public function setArray(array $array);

    public function addX($x);
    public function addY($y);
    public function add($x, $y = null);
    public function addArray(array $array);

    public function subtractX($x);
    public function subtractY($y);
    public function subtract($x, $y = null);
    public function subtractArray(array $array);

    public function divideX($x);
    public function divideY($y);
    public function divide($x, $y = null);
    public function divideArray(array $array);

    public function multiplyX($x);
    public function multiplyY($y);
    public function multiply($x, $y = null);
    public function multiplyArray(array $array);
}