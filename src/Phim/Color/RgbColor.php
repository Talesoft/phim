<?php

namespace Phim\Color;

class RgbColor implements RgbColorInterface
{
    use RgbColorTrait;

    public function __construct($red, $green, $blue)
    {

        $this->red = intval($red);
        $this->green = intval($green);
        $this->blue = intval($blue);
    }

    public function withAlphaSupport()
    {

        return new RgbaColor($this->red, $this->green, $this->blue, 1);
    }

    public function withoutAlphaSupport()
    {

        return new self($this->red, $this->green, $this->blue);
    }

    public function getMax()
    {

        return max($this->red, $this->green, $this->blue);
    }

    public function getAverage()
    {

        return ($this->red + $this->green + $this->blue) / 3;
    }

    public function getMin()
    {

        return min($this->red, $this->blue, $this->green);
    }

    public function getRgb()
    {

        return new self($this->red, $this->green, $this->blue);
    }

    public function getRgba()
    {

        return $this->withAlphaSupport();
    }

    public function getHsl()
    {

        $r = $this->red / 255;
        $g = $this->green / 255;
        $b = $this->blue / 255;

        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $h = $s = 0;
        $l = ($max + $min) / 2;

        if ($max !== $min) {

          $d = $max - $min;
          $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);

          switch ($max) {
              case $r: $h = ($g - $b) / $d + ($g < $b ? 6 : 0); break;
              case $g: $h = ($b - $r) / $d + 2; break;
              case $b: $h = ($r - $g) / $d + 4; break;
          }

          $h /= 6;
        }

        return new HslColor($h * 360, $s, $l);
    }

    public function getHsla()
    {

        return $this->getHsl()->withAlphaSupport();
    }

    public function getHsv()
    {

        $r = $this->red / 255;
        $g = $this->green / 255;
        $b = $this->blue / 255;

        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $d = $max - $min;

        $h = $s = 0;
        $s = $max === 0 ? 0 : $d / $max;
        $v = $max;

        if ($max !== $min) {

            switch ($max) {
                case $r: $h = ($g - $b) / $d + ($g < $b ? 6 : 0); break;
                case $g: $h = ($b - $r) / $d + 2; break;
                case $b: $h = ($r - $g) / $d + 4; break;
            }

            $h /= 6;
        }

        return new HsvColor($h * 360, $s, $v);
    }

    public function getHsva()
    {

        return $this->getHsv()->withAlphaSupport();
    }

    public function __toString()
    {

        return "rgb({$this->red},{$this->blue},{$this->green})";
    }
}