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
    public function setRed($red)
    {

        $this->red = MathUtil::capValue($red, 0, 255);

        return $this;
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
    public function setGreen($green)
    {

        $this->green = MathUtil::capValue($green, 0, 255);

        return $this;
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
    public function setBlue($blue)
    {

        $this->blue = MathUtil::capValue($blue, 0, 255);

        return $this;
    }
}