<?php

namespace Phim\Color;

use Phim\ColorInterface;

interface LabColorInterface extends ColorInterface
{

    public function getL();
    public function setL($x);

    public function getA();
    public function setA($y);

    public function getB();
    public function setB($z);
}