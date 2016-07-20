<?php
declare(strict_types=1);

namespace Phim\Color;

use Phim\ColorBase;
use Phim\ColorInterface;
use Phim\Util\MathUtil;

class RgbColor extends ColorBase implements RgbColorInterface
{
    use RgbColorTrait;

    public function __construct(int $red, int $green, int $blue)
    {

        $this->red = MathUtil::capInt($red, 255);
        $this->green = MathUtil::capInt($green, 255);
        $this->blue = MathUtil::capInt($blue, 255);
    }

    public function withAlphaSupport(): AlphaColorInterface
    {

        return new RgbaColor($this->red, $this->green, $this->blue, 1);
    }

    public function withoutAlphaSupport(): ColorInterface
    {

        return new self($this->red, $this->green, $this->blue);
    }

    public function getRgb(): RgbColorInterface
    {

        return new self($this->red, $this->green, $this->blue);
    }

    public function getRgba(): RgbaColorInterface
    {

        return $this->withAlphaSupport();
    }

    public function getHsl(): HslColorInterface
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

        return new HslColor((int)($h * 360), $s, $l);
    }

    public function getHsla(): HslaColorInterface
    {

        return $this->getHsl()->withAlphaSupport();
    }

    public function getHsv(): HsvColorInterface
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

        return new HsvColor((int)($h * 360), $s, $v);
    }

    public function getHsva(): HsvaColorInterface
    {

        return $this->getHsv()->withAlphaSupport();
    }

    public function __toString()
    {

        return "rgb({$this->red},{$this->green},{$this->blue})";
    }
}