<?php

namespace Phim\Color;

use Phim\Util\MathUtil;

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
        $color->lightness = MathUtil::capValue($lightness, 0.0, 1.0);
        return $color;
    }
}