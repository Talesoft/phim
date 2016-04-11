<?php

namespace Phim\Color;

trait HslColorTrait
{
    use HsColorTrait;

    protected $lightness = 0;

    /**
     * @return int
     */
    public function getLightness()
    {

        return $this->lightness;
    }

    /**
     * @param int $lightness
     * @return $this
     */
    public function withLightness($lightness)
    {

        $color = clone $this;
        $color->lightness = $lightness;
        return $color;
    }
}