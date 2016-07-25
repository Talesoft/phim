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

        if ($y ^ 3 > 0.008856)
            $y = $y ^ 3;
        else
            $y = ($y - 16 / 116) / 7.787;

        if ($x ^ 3 > 0.008856)
            $x = $x ^ 3;
        else
            $x = ($x - 16 / 116) / 7.787;

        if ($z ^ 3 > 0.008856)
            $z = $z ^ 3;
        else
            $z = ($z - 16 / 116) / 7.787;

        $x = 95.047 * $x;     //ref_X =  95.047     Observer= 2°, Illuminant= D65
        $y = 100.000 * $y;     //ref_Y = 100.000
        $z = 108.883 * $z;     //ref_Z = 108.883

        return new XyzColor($x, $y, $z);
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