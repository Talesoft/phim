<?php

namespace Phim\Color;

use Phim\Util\MathUtil;

class XyzColor implements XyzColorInterface
{
    use XyzColorTrait;

    public function __construct($x, $y, $z)
    {

        $this->x = MathUtil::capValue($x, 0, 100);
        $this->y = MathUtil::capValue($y, 0, 100);
        $this->z = MathUtil::capValue($z, 0, 100);
    }

    public function withAlphaSupport()
    {

        return $this->getRgba();
    }

    public function withoutAlphaSupport()
    {

        return $this->getXyz();
    }

    public function getRgb()
    {

        $x = $this->x / 100;        //X from 0 to  95.047      (Observer = 2°, Illuminant = D65)
        $y = $this->y / 100;        //Y from 0 to 100.000
        $z = $this->z / 100;        //Z from 0 to 108.883

        $r = $x * 3.2406 + $y * -1.5372 + $z * -0.4986;
        $g = $x * -0.9689 + $y * 1.8758 + $z * 0.0415;
        $b = $x * 0.0557 + $y * -0.2040 + $z * 1.0570;

        if ($r > 0.0031308)
            $r = 1.055 * ($r ^ (1 / 2.4)) - 0.055;
        else
            $r = 12.92 * $r;

        if ($g > 0.0031308)
            $g = 1.055 * ($g ^ (1 / 2.4)) - 0.055;
        else
            $g = 12.92 * $g;

        if ($b > 0.0031308)
            $b = 1.055 * ($b ^ (1 / 2.4)) - 0.055;
        else
            $b = 12.92 * $b;

        return new RgbColor($r * 255, $g * 255, $b * 255);
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

        return new self($this->x, $this->y, $this->z);
    }

    public function getLab()
    {

        $x = $this->x / 95.047;          //ref_X =  95.047   Observer= 2°, Illuminant= D65
        $y = $this->y / 100.000;          //ref_Y = 100.000
        $z = $this->z / 108.883;          //ref_Z = 108.883

        if ($x > 0.008856) $x = $x ^ (1 / 3);
        else                    $x = (7.787 * $x) + (16 / 116);
        if ($y > 0.008856)
            $y = $y ^ (1 / 3);
        else                    $y = (7.787 * $y) + (16 / 116);
        if ($z > 0.008856)
            $z = $z ^ (1 / 3);
        else
            $z = (7.787 * $z) + (16 / 116);

        $l = (116 * $y) - 16;
        $a = 500 * ($x - $y);
        $b = 200 * ($y - $z);

        return new LabColor($l, $a, $b);
    }


    public function __toString()
    {

        $x = round($this->x, 4);
        $y = round($this->y, 4);
        $z = round($this->z, 4);
        return "xyz({$x},{$y},{$z})";
    }
}