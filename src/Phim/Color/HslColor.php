<?php
declare(strict_types=1);

namespace Phim\Color;

use Phim\ColorInterface;
use Phim\Util\MathUtil;

class HslColor extends HsColorBase implements HslColorInterface
{
    use HslColorTrait;

    public function __construct(int $hue, float $saturation, float $lightness)
    {

        parent::__construct($hue, $saturation);

        $this->lightness = MathUtil::capFloat($lightness);
    }

    public function withAlphaSupport(): AlphaColorInterface
    {

        return new HslaColor($this->hue, $this->saturation, $this->lightness, 1);
    }

    public function withoutAlphaSupport(): ColorInterface
    {

        return new HslColor($this->hue, $this->saturation, $this->lightness);
    }

    private function getRgbFromHue(float $p, float $q, float $t): float
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

    public function getRgb(): RgbColorInterface
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

        return new RgbColor(
            (int)($r * 255),
            (int)($g * 255),
            (int)($b * 255)
        );
    }

    public function getRgba(): RgbaColorInterface
    {

        return $this->getRgb()->withAlphaSupport();
    }

    public function getHsl(): HslColorInterface
    {

        return new HslColor($this->hue, $this->saturation, $this->lightness);
    }

    public function getHsla(): HslaColorInterface
    {

        return $this->withAlphaSupport();
    }

    public function getHsv(): HsvColorInterface
    {
        $l = $this->lightness;
        $s = $this->saturation * ($l < .5 ? $l : 1 - $l);

        return new HsvColor(
            $this->hue,
            2 * $s / ($l + $s),
            $l + $s
        );
    }

    public function getHsva(): HsvaColorInterface
    {

        return $this->getHsv()->withAlphaSupport();
    }

    public function __toString()
    {

        return "hsl({$this->hue},{$this->saturation},{$this->lightness})";
    }
}