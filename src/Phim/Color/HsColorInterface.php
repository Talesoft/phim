<?php

namespace Phim\Color;

use Phim\ColorInterface;

interface HsColorInterface extends ColorInterface
{

    public function getHue();
    public function setHue($hue);

    public function getSaturation();
    public function setSaturation($saturation);
}