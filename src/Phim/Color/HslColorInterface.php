<?php

namespace Phim\Color;

interface HslColorInterface extends HsColorInterface
{

    public function getLightness();
    public function setLightness($lightness);
}