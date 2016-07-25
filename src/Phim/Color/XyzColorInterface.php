<?php

namespace Phim\Color;

use Phim\ColorInterface;

interface XyzColorInterface extends ColorInterface
{

    public function getX();
    public function withX($x);

    public function getY();
    public function withY($y);

    public function getZ();
    public function withZ($z);
}