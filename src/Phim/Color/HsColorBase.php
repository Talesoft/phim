<?php

namespace Phim\Color;

abstract class HsColorBase implements HsColorInterface
{
    use HsColorTrait;

    public function __construct($hue, $saturation)
    {

        $this->setHue($hue);
        $this->setSaturation($saturation);
    }
}