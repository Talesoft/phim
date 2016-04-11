<?php

namespace Phim\Color;

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
        $color->hue = $hue;
        return $this;
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
        $color->saturation = $saturation;
        return $this;
    }
}