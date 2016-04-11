<?php

namespace Phim\Color;

class RgbColor implements RgbColorInterface
{
    use RgbColorTrait;

    public function __construct($red, $green, $blue)
    {

        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
    }

    public function withAlphaSupport()
    {

        return new RgbaColor($this->red, $this->green, $this->blue, 1);
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

        return $this;
    }

    public function getCmyk()
    {

        $c = 255 - $this->red;
        $m = 255 - $this->green;
        $y = 255 - $this->blue;
        $k = min($c, $m, $y);
        $delta = 255 - $k;

        if ($delta === 0)
            $c = $m = $y = 0;
        else {

            $c = ($c - $k) / $delta;
            $m = ($m - $k) / $delta;
            $y = ($y - $k) / $delta;
        }

        return new CmykColor($c, $m, $y, $k);
    }

    public function getHsl()
    {

        $r = $this->red / 255;
        $g = $this->green / 255;
        $b = $this->blue / 255;
        
        $min = min($r, $g, $b);
        $max = max($r, $g, $b);
        $delta = $max - $min;

        $h = $s = $l = 0;
        $l = ($max + $min) / 2;

        if ($delta != 0) { //For some reason, sometimes $delta is 0 but fails the !== check which throws a division error. We check loosely, that seems to work.

            if ($l < 0.5)
                $s = $delta / ($max + $min);
            else
                $s = $delta / (2 - $max - $min);

            $deltaR = ((($max - $r) / 6) + ($delta / 2)) / $delta;
            $deltaG = ((($max - $g) / 6) + ($delta / 2)) / $delta;
            $deltaB = ((($max - $b) / 6) + ($delta / 2)) / $delta;

            if ($r == $max)
                $h = $deltaB - $deltaG;
            else if ($g == $max)
                $h = (1 / 3) + $deltaR - $deltaB;
            else if ($b == $max)
                $h = (2 / 3) + $deltaG - $deltaR;

            if ($h < 0) $h++;
            if ($h > 1) $h--;
        }

        return new HslColor($h * 360, $s, $l);
    }

    public function getHsv()
    {

        //This is actually the same as to HSL except for $l, which is $max always here.
        //Maybe there's a way to combine those two smoothly?
        $r = $this->red / 255;
        $g = $this->green / 255;
        $b = $this->blue / 255;

        $min = min($r, $g, $b);
        $max = max($r, $g, $b);
        $delta = $max - $min;

        $h = $s = $l = 0;
        $l = $max;

        if ($delta != 0) { //For some reason, sometimes $delta is 0 but fails the !== check which throws a division error. We check loosely, that seems to work.

            $s = $delta / $max;

            $deltaR = ((($max - $r) / 6) + ($delta / 2)) / $delta;
            $deltaG = ((($max - $g) / 6) + ($delta / 2)) / $delta;
            $deltaB = ((($max - $b) / 6) + ($delta / 2)) / $delta;

            if ($r == $max)
                $h = $deltaB - $deltaG;
            else if ($g == $max)
                $h = (1 / 3) + $deltaR - $deltaB;
            else if ($b == $max)
                $h = (2 / 3) + $deltaG - $deltaR;

            if ($h < 0) $h++;
            if ($h > 1) $h--;
        }

        return new HsvColor($h * 360, $s, $l);
    }

    public function __toString()
    {

        return "rgb({$this->red},{$this->blue},{$this->green})";
    }
}