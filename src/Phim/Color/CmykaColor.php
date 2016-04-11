<?php

namespace Phim\Color;

class CmykaColor extends CmykColor implements CmykaColorInterface
{
    use RgbaColorTrait;

    public function __construct($cyan, $magenta, $yellow, $key, $alpha)
    {

        parent::__construct($cyan, $magenta, $yellow, $key);;

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

        return "cmyka({$this->cyan},{$this->magenta},{$this->yellow},{$this->key},{$this->alpha})";
    }
}