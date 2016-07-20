<?php

namespace Phim\Color;

use Phim\Util\MathUtil;

class RgbaColor extends RgbColor implements RgbaColorInterface
{
    use RgbaColorTrait;

    public function __construct($red, $green, $blue, $alpha)
    {

        parent::__construct($red, $green, $blue);

        $this->alpha = MathUtil::capValue($alpha, 0.0, 1.0);
    }

    public function getRgba()
    {

        return new RgbaColor($this->red, $this->green, $this->blue, $this->alpha);
    }

    public function getHsla()
    {

        return $this->getHsl()->withAlphaSupport()->withAlpha($this->alpha);
    }

    public function getHsva()
    {

        return $this->getHsv()->withAlphaSupport()->withAlpha($this->alpha);
    }

    public function __toString()
    {

        return "rgba({$this->red},{$this->green},{$this->blue},{$this->alpha})";
    }
}