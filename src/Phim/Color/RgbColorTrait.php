<?php

namespace Phim\Color;

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
        $color->red = $red;
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
    public function withGreen($green)
    {

        $color = clone $this;
        $color->green = $green;
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
    public function withBlue($blue)
    {

        $color = clone $this;
        $color->blue = $blue;
        return $this;
    }
}