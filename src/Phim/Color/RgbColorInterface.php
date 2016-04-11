<?php

namespace Phim\Color;

use Phim\ColorInterface;

interface RgbColorInterface extends ColorInterface
{

    public function getRed();
    public function withRed($red);

    public function getBlue();
    public function withBlue($blue);

    public function getGreen();
    public function withGreen($green);
}