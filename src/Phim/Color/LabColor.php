<?php

namespace Phim\Color;

use Phim\Util\MathUtil;

//http://www.easyrgb.com/index.php?X=MATH&H=07#text7
class LabColor implements LabColorInterface
{
    use LabColorTrait;

    public function __construct($l, $a, $b)
    {

        $this->l = $l; //MathUtil::capValue($l, 0, 100);
        $this->a = $a; //MathUtil::capValue($a, -128, 127);
        $this->b = $b; //MathUtil::capValue($b, -128, 127);
    }

    public function withAlphaSupport()
    {

        return $this->getRgba();
    }

    public function withoutAlphaSupport()
    {

        return $this->getLab();
    }

    public function getRgb()
    {

        return $this->getXyz()->getRgb();
    }

    public function getRgba()
    {

        return $this->getRgb()->withAlphaSupport();
    }

    public function getHsl()
    {

        return $this->getRgb()->getHsl();
    }

    public function getHsla()
    {

        return $this->getHsl()->withAlphaSupport();
    }

    public function getHsv()
    {

        return $this->getRgb()->getHsv();
    }

    public function getHsva()
    {

        return $this->getHsv()->withAlphaSupport();
    }

    public function getXyz()
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

    public function getLab()
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