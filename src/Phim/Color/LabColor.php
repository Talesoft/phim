<?php

namespace Phim\Color;

use Phim\Util\MathUtil;

//http://www.easyrgb.com/index.php?X=MATH&H=07#text7
class LabColor implements LabColorInterface
{
    use LabColorTrait;

    public function __construct($l, $a, $b)
    {

        $this->setL($l);
        $this->setA($a);
        $this->setB($b);
    }

    public function toAlpha()
    {

        return $this->toRgba();
    }

    public function toOpaque()
    {

        return $this->toLab();
    }

    public function toRgb()
    {

        return $this->toXyz()->toRgb();
    }

    public function toRgba()
    {

        return $this->toRgb()->toAlpha();
    }

    public function toHsl()
    {

        return $this->toRgb()->toHsl();
    }

    public function toHsla()
    {

        return $this->toHsl()->toAlpha();
    }

    public function toHsv()
    {

        return $this->toRgb()->toHsv();
    }

    public function toHsva()
    {

        return $this->toHsv()->toAlpha();
    }

    public function toXyz()
    {

        $y = ($this->l + 16) / 116;
        $x = $this->a / 500 + $y;
        $z = $y - $this->b / 200;

        $y2 = pow($y, 3);
        $x2 = pow($x, 3);
        $z2 = pow($z, 3);

        $y = $y2 > 0.008856 ? $y2 : ($y - 16 / 116) / 7.787;
        $x = $x2 > 0.008856 ? $x2 : ($x - 16 / 116) / 7.787;
        $z = $z2 > 0.008856 ? $z2 : ($z - 16 / 116) / 7.787;

        return new XyzColor($x * XyzColor::REF_X, $y * XyzColor::REF_Y, $z * XyzColor::REF_Z);
    }

    public function toLab()
    {

        return new LabColor($this->l, $this->a, $this->b);
    }

    public function __toString()
    {

        $l = round($this->l, 4);
        $a = round($this->a, 4);
        $b = round($this->b, 4);
        return "lab({$l},{$a},{$b})";
    }
}