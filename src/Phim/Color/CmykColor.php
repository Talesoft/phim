<?php

namespace Phim\Color;

class CmykColor implements CmykColorInterface
{
    use CmykColorTrait;

    public function __construct($cyan, $magenta, $yellow, $key)
    {

        $this->cyan = $cyan;
        $this->magenta = $magenta;
        $this->yellow = $yellow;
        $this->key = $key;
    }

    public function withAlphaSupport()
    {

        return new CmykaColor($this->cyan, $this->magenta, $this->yellow, $this->key, 1);
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

        return "cmyk({$this->cyan},{$this->magenta},{$this->yellow},{$this->key})";
    }
}