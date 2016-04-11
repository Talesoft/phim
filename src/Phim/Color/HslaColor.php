<?php

namespace Phim\Color;

class HslaColor extends HslColor implements HslaColorInterface
{
    use HslaColorTrait;

    public function __construct($hue, $saturation, $lightness, $alpha)
    {

        parent::__construct($hue, $saturation, $lightness);;

        $this->alpha = $alpha;
    }

    public function getRgba()
    {

        return $this->getRgb()->withAlphaSupport()->withAlpha($this->alpha);
    }

    public function getHsla()
    {

        return new HslaColor($this->hue, $this->saturation, $this->lightness, $this->alpha);
    }

    public function getHsva()
    {

        return $this->getHsv()->withAlphaSupport()->withAlpha($this->alpha);
    }

    public function __toString()
    {

        return "hsla({$this->hue},{$this->saturation},{$this->lightness},{$this->alpha})";
    }
}