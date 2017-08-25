<?php

namespace Phim\Color;

class RgbaColor extends RgbColor implements RgbaColorInterface
{
    use RgbaColorTrait;

    public function __construct($red, $green, $blue, $alpha)
    {

        parent::__construct($red, $green, $blue);

        $this->setAlpha($alpha);
    }

    public function toRgba()
    {

        return new RgbaColor($this->red, $this->green, $this->blue, $this->alpha);
    }

    public function toHsla()
    {

        return parent::toHsla()->setAlpha($this->alpha);
    }

    public function toHsva()
    {

        return parent::toHsva()->setAlpha($this->alpha);
    }

    public function __toString()
    {

        $r = intval($this->red);
        $g = intval($this->green);
        $b = intval($this->blue);
        $alph = round($this->alpha, 2);

        return sprintf("rgba(%d,%d,%d,%s)", $r, $g, $b, number_format($alph, 2, '.', null));
    }
}