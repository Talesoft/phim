<?php

namespace Phim\Color;

abstract class HsColorBase implements HsColorInterface
{
    use HsColorTrait;

    public function __construct($hue, $saturation)
    {

        $this->hue = intval($hue);
        $this->saturation = min(1, max($saturation, 0));
    }
}