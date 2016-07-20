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
    public function getRed(): int
    {

        return $this->red;
    }

    /**
     * @param int $red
     * @return $this|RgbColorInterface
     */
    public function withRed(int $red): RgbColorInterface
    {

        $color = clone $this;
        $color->red = $red;
        return $color;
    }

    /**
     * @return int
     */
    public function getGreen(): int
    {

        return $this->green;
    }

    /**
     * @param int $green
     * @return $this|RgbColorInterface
     */
    public function withGreen(int $green): RgbColorInterface
    {

        $color = clone $this;
        $color->green = $green;
        return $color;
    }

    /**
     * @return int
     */
    public function getBlue(): int
    {

        return $this->blue;
    }

    /**
     * @param int $blue
     * @return $this|RgbColorInterface
     */
    public function withBlue(int $blue): RgbColorInterface
    {

        $color = clone $this;
        $color->blue = $blue;
        return $color;
    }
}