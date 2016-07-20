<?php

namespace Phim\Color;

use Phim\Util\MathUtil;

trait RgbColorTrait
{

    protected $red = 0;
    protected $green = 0;
    protected $blue = 0;

    /**
     * @return int
     */
    public function getRed()
    {

        return $this->red;
    }

    /**
     * @param int $red
     * @return $this
     */
    public function withRed($red)
    {

        $color = clone $this;
        $color->red = MathUtil::capValue($red, 0, 255);
        return $color;
    }

    /**
     * @return int
     */
    public function getGreen()
    {

        return $this->green;
    }

    /**
     * @param int $green
     * @return $this
     */
    public function withGreen($green)
    {

        $color = clone $this;
        $color->green = MathUtil::capValue($green, 0, 255);
        return $color;
    }

    /**
     * @return int
     */
    public function getBlue()
    {

        return $this->blue;
    }

    /**
     * @param int $blue
     * @return $this
     */
    public function withBlue($blue)
    {

        $color = clone $this;
        $color->blue = MathUtil::capValue($blue, 0, 255);
        return $color;
    }
}