<?php

namespace Phim\Color;

use Phim\ColorInterface;

interface RgbColorInterface extends ColorInterface
{

    public function getRed();
    public function setRed($red);

    public function getBlue();
    public function setBlue($blue);

    public function getGreen();
    public function setGreen($green);
}