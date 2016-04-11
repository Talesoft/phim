<?php

namespace Phim\Color;

class HsvColor extends HsColorBase implements HsvColorInterface
{
    use HsvColorTrait;

    public function __construct($hue, $saturation, $value)
    {

        parent::__construct($hue, $saturation);

        $this->value = $value;
    }

    public function withAlphaSupport()
    {

        return new HsvaColor($this->hue, $this->saturation, $this->value, 1);
    }

    public function getRgb()
    {
        // TODO: Implement getRgb() method.
    }

    public function getCmyk()
    {
        // TODO: Implement getCmyk() method.
    }

    public function getHsl()
    {
        // TODO: Implement getHsl() method.
    }

    public function getHsv()
    {
        // TODO: Implement getHsv() method.
    }

    public function __toString()
    {

        return "hsv({$this->hue},{$this->saturation},{$this->value})";
    }
}