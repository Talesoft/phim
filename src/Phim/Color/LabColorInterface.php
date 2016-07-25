<?php

namespace Phim\Color;

use Phim\ColorInterface;

interface LabColorInterface extends ColorInterface
{

    public function getL();
    public function withL($x);

    public function getA();
    public function withA($y);

    public function getB();
    public function withB($z);
}