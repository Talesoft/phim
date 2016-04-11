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

    public function getRgb()
    {
        // TODO: Implement getRgb() method.
    }

    public function getRgba()
    {
        // TODO: Implement getRgba() method.
    }

    public function getCmyk()
    {
        // TODO: Implement getCmyk() method.
    }

    public function getCmyka()
    {
        // TODO: Implement getCmyka() method.
    }

    public function getHsl()
    {
        // TODO: Implement getHsl() method.
    }

    public function getHsla()
    {
        // TODO: Implement getHsla() method.
    }

    public function getHsv()
    {
        // TODO: Implement getHsv() method.
    }

    public function getHsva()
    {
        // TODO: Implement getHsva() method.
    }

    public function __toString()
    {

        return "hsla({$this->hue},{$this->saturation},{$this->lightness},{$this->alpha})";
    }
}