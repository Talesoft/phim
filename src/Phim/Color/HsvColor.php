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

    public function withoutAlphaSupport()
    {

        return new HsvColor($this->hue, $this->saturation, $this->value);
    }

    public function getRgb()
    {

        $h = $this->hue / 360;
        $s = $this->saturation;
        $v = $this->value;

        $r = $g = $b = 0;

        $i = floor($h * 6);
        $f = $h * 6 - $i;
        $p = $v * (1 - $s);
        $q = $v * (1 - $f * $s);
        $t = $v * (1 - (1 - $f) * $s);

        switch ($i % 6) {
            case 0: $r = $v; $g = $t; $b = $p; break;
            case 1: $r = $q; $g = $v; $b = $p; break;
            case 2: $r = $p; $g = $v; $b = $t; break;
            case 3: $r = $p; $g = $q; $b = $v; break;
            case 4: $r = $t; $g = $p; $b = $v; break;
            case 5: $r = $v; $g = $p; $b = $q; break;
        }

        return new RgbColor($r * 255, $g * 255, $b * 255);
    }

    public function getRgba()
    {

        return $this->getRgb()->withAlphaSupport();
    }

    public function getHsl()
    {

        $h = $this->hue;
        $s = $this->saturation;
        $v = $this->value;

        return new HslColor(
            $h,
            $s * $v / (($h = (2 - $s) * $v) < 1 ? $h : 2 - $h),
            $h / 2
        );
    }

    public function getHsla()
    {

        return $this->getHsl()->withAlphaSupport();
    }

    public function getHsv()
    {

        return new HsvColor($this->hue, $this->saturation, $this->value);
    }

    public function getHsva()
    {

        return $this->withAlphaSupport();
    }

    public function __toString()
    {

        return "hsv({$this->hue},{$this->saturation},{$this->value})";
    }
}