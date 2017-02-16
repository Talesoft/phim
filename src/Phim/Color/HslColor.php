<?php

namespace Phim\Color;

use Phim\Util\MathUtil;

class HslColor extends HsColorBase implements HslColorInterface
{
    use HslColorTrait;

    public function __construct($hue, $saturation, $lightness)
    {

        parent::__construct($hue, $saturation);

        $this->setLightness($lightness);
    }

    public function toAlpha()
    {

        return $this->toHsla();
    }

    public function toOpaque()
    {

        return $this->toHsl();
    }

    private function getRgbFromHue($p, $q, $t)
    {

        //Normalize
        if ($t < 0)
            $t += 1;
        else if ($t > 1)
            $t -= 1;

        if ($t < 1/6)
            return $p + ($q - $p) * 6 * $t;

        if ($t < 1/2)
            return $q;

        if ($t < 2/3)
            return $p + ($q - $p) * (2/3 - $t) * 6;

        return $p;
    }

    public function toRgb()
    {

        $r = $g = $b = 0;

        $h = $this->hue / 360;
        $s = $this->saturation;
        $l = $this->lightness;

        if ($s === 0)
            $r = $g = $b = $l;
        else {

            $q = $l < 0.5 ? $l * (1 + $s) : $l + $s - $l * $s;
            $p = 2 * $l - $q;

            $r = $this->getRgbFromHue($p, $q, $h + 1/3);
            $g = $this->getRgbFromHue($p, $q, $h);
            $b = $this->getRgbFromHue($p, $q, $h - 1/3);
        }

        return new RgbColor($r * 255, $g * 255, $b * 255);
    }

    public function toRgba()
    {

        return $this->toRgb()->toAlpha();
    }

    public function toHsl()
    {

        return new HslColor($this->hue, $this->saturation, $this->lightness);
    }

    public function toHsla()
    {

        return new HslaColor($this->hue, $this->saturation, $this->lightness, 1);
    }

    public function toHsv()
    {
        $l = $this->lightness;
        $s = $this->saturation * ($l < .5 ? $l : 1 - $l);

        return new HsvColor(
            $this->hue,
            2 * $s / ($l + $s),
            $l + $s
        );
    }

    public function toHsva()
    {

        return $this->toHsv()->toAlpha();
    }

    public function toXyz()
    {

        return $this->toRgb()->toXyz();
    }

    public function toLab()
    {

        return $this->toRgb()->toLab();
    }


    public function __toString()
    {

        $hue = round($this->hue, 2);
        $sat = round($this->saturation * 100, 2).'%';
        $light = round($this->lightness * 100, 2).'%';
        return "hsl({$hue},{$sat},{$light})";
    }
}