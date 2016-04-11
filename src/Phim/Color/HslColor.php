<?php

namespace Phim\Color;

class HslColor extends HsColorBase implements HslColorInterface
{
    use HslColorTrait;

    public function __construct($hue, $saturation, $lightness)
    {

        parent::__construct($hue, $saturation);

        $this->lightness = $lightness;
    }

    public function withAlphaSupport()
    {

        return new HslaColor($this->hue, $this->saturation, $this->lightness, 1);
    }

    public function getRgb()
    {

        $h = $this->hue;
        $s = $this->saturation;
        $l = $this->lightness;
        $rgb = [0, 0, 0];

        if ($s === 0)
            return new RgbColor($l * 255, $l * 255, $l * 255);

        $chroma = (1 - abs(2 * $l - 1)) * $s;
        $hue = (($h / 360) * 6);
        $x = $chroma * (1 - abs((fmod($hue, 2)) - 1)); // Note: fmod because % (modulo) returns int value!!
        $m = $l - round($chroma / 2, 10); // Bugfix for strange float behaviour (e.g. $l=0.17 and $s=1)

        if ($hue >= 0 && $hue < 1) $rgb = [($chroma + $m), ($x + $m), $m];
        else if ($hue >= 1 && $hue < 2) $rgb = [($x + $m), ($chroma + $m), $m];
        else if ($hue >= 2 && $hue < 3) $rgb = [$m, ($chroma + $m), ($x + $m)];
        else if ($hue >= 3 && $hue < 4) $rgb = [$m, ($x + $m), ($chroma + $m)];
        else if ($hue >= 4 && $hue < 5) $rgb = [($x + $m), $m, ($chroma + $m)];
        else if ($hue >= 5 && $hue < 6) $rgb = [($chroma + $m), $m, ($x + $m)];

        list($r, $g, $b) = $rgb;
        return new RgbColor($r * 255, $g * 255, $b * 255);
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

        return "hsl({$this->hue},{$this->saturation},{$this->lightness})";
    }
}