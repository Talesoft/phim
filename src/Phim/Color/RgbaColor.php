<?php
declare(strict_types=1);

namespace Phim\Color;

use Phim\Util\MathUtil;

class RgbaColor extends RgbColor implements RgbaColorInterface
{
    use RgbaColorTrait;

    public function __construct(int $red, int $green, int $blue, float $alpha)
    {

        parent::__construct($red, $green, $blue);

        $this->alpha = MathUtil::capFloat($alpha);
    }

    public function withAlphaSupport(): AlphaColorInterface
    {

        return new self($this->red, $this->green, $this->blue, $this->alpha);
    }

    public function getRgba(): RgbaColorInterface
    {

        return new RgbaColor($this->red, $this->green, $this->blue, $this->alpha);
    }

    public function getHsla(): HslaColorInterface
    {

        return $this->getHsl()->withAlphaSupport()->withAlpha($this->alpha);
    }

    public function getHsva(): HsvaColorInterface
    {

        return $this->getHsv()->withAlphaSupport()->withAlpha($this->alpha);
    }

    public function __toString()
    {

        return "rgba({$this->red},{$this->green},{$this->blue},{$this->alpha})";
    }
}