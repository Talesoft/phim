<?php

namespace Phim\Color;

use Phim\ColorInterface;

interface HsColorInterface extends ColorInterface
{

    public function getHue();
    public function withHue($hue);

    public function getSaturation();
    public function withSaturation($saturation);
}