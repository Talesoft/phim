<?php

namespace Phim\Color;

class RgbaColor extends RgbColor implements RgbaColorInterface
{
    use RgbaColorTrait;

    public function __construct($red, $green, $blue, $alpha)
    {

        parent::__construct($red, $green, $blue);

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

        return "rgba({$this->red},{$this->blue},{$this->green},{$this->alpha})";
    }
}