<?php

namespace Phim\Color;

use Phim\Util\MathUtil;

class HslaColor extends HslColor implements HslaColorInterface
{
    use HslaColorTrait;

    public function __construct($hue, $saturation, $lightness, $alpha)
    {

        parent::__construct($hue, $saturation, $lightness);;

        $this->setAlpha($alpha);
    }

    public function toRgba()
    {

        return parent::toRgba()->setAlpha($this->alpha);
    }

    public function toHsla()
    {

        return new static($this->hue, $this->saturation, $this->lightness, $this->alpha);
    }

    public function toHsva()
    {

        return parent::toHsva()->setAlpha($this->alpha);
    }

    public function __toString()
    {

        $hue = round($this->hue, 2);
        $sat = round($this->saturation * 100, 2).'%';
        $light = round($this->lightness * 100, 2).'%';
        $alph = round($this->alpha, 2);
        return "hsla({$hue},{$sat},{$light},{$alph})";
    }
}