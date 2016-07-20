<?php

namespace Phim\Color;

use Phim\Util\MathUtil;

abstract class HsColorBase implements HsColorInterface
{
    use HsColorTrait;

    public function __construct($hue, $saturation)
    {

        $this->hue = MathUtil::rotateValue($hue, 360);
        $this->saturation = MathUtil::capValue($saturation, 0.0, 1.0);
    }
}