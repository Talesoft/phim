<?php

namespace Phim\Color;

use Phim\Util\MathUtil;

class XyzColor implements XyzColorInterface
{
    use XyzColorTrait;

    //Observer= 2°, Illuminant= D65
    const REF_X = 95.047;
    const REF_Y = 100.0;
    const REF_Z = 108.883;


    public function __construct($x, $y, $z)
    {

        $this->x = MathUtil::capValue($x, 0, self::REF_X);
        $this->y = MathUtil::capValue($y, 0, self::REF_Y);
        $this->z = MathUtil::capValue($z, 0, self::REF_Z);
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

        $x = $this->x / 100; //X from 0 to self::REF_X
        $y = $this->y / 100; //Y from 0 to self::REF_Y
        $z = $this->z / 100; //Z from 0 to self::REF_Z

        //Observer = 2°, Illuminant = D65
        $r = $x * 3.2406 + $y * -1.5372 + $z * -0.4986;
        $g = $x * -0.9689 + $y * 1.8758 + $z * 0.0415;
        $b = $x * 0.0557 + $y * -0.2040 + $z * 1.0570;

        //Assume sRGB
        $r = $r > 0.0031308 ? ((1.055 * pow($r, 1.0 / 2.4)) - 0.055) : $r * 12.92;
        $g = $g > 0.0031308 ? ((1.055 * pow($g, 1.0 / 2.4)) - 0.055) : $g * 12.92;
        $b = $b > 0.0031308 ? ((1.055 * pow($b, 1.0 / 2.4)) - 0.055) : $b * 12.92;

        return new RgbColor(
            round($r * 255, 0, PHP_ROUND_HALF_UP),
            round($g * 255, 0, PHP_ROUND_HALF_UP),
            round($b * 255, 0, PHP_ROUND_HALF_UP)
        );
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

        $x = $this->x / self::REF_X;
        $y = $this->y / self::REF_Y;
        $z = $this->z / self::REF_Z;

        $x = $x > 0.008856 ? pow($x, 1 / 3) : (7.787 * $x) + (16 / 116);
        $y = $y > 0.008856 ? pow($y, 1 / 3) : (7.787 * $y) + (16 / 116);
        $z = $z > 0.008856 ? pow($z, 1 / 3) : (7.787 * $z) + (16 / 116);

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