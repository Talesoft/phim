<?php

namespace Phim\Color;

use Phim\Util\MathUtil;

trait HsColorTrait
{

    protected $hue = 0;
    protected $saturation = 0;

    /**
     * @return int
     */
    public function getHue()
    {

        return $this->hue;
    }

    /**
     * @param int $hue
     * @return $this
     */
    public function withHue($hue)
    {

        $color = clone $this;
        $color->hue = MathUtil::rotateValue($hue, 360);
        return $color;
    }

    /**
     * @return int
     */
    public function getSaturation()
    {

        return $this->saturation;
    }

    /**
     * @param int $saturation
     * @return $this
     */
    public function withSaturation($saturation)
    {

        $color = clone $this;
        $color->saturation = MathUtil::capValue($saturation, 0.0, 1.0);
        return $color;
    }
}