<?php

namespace Phim\Color;

use Phim\ColorInterface;

interface XyzColorInterface extends ColorInterface
{

    //Observer= 2°, Illuminant= D65
    const REF_X = 95.047;
    const REF_Y = 100.0;
    const REF_Z = 108.883;


    public function getX();
    public function setX($x);

    public function getY();
    public function setY($y);

    public function getZ();
    public function setZ($z);
}