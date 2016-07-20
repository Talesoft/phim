<?php
declare(strict_types=1);

namespace Phim\Color;

use Phim\Util\MathUtil;

class HslaColor extends HslColor implements HslaColorInterface
{
    use HslaColorTrait;

    public function __construct(int $hue, float $saturation, float $lightness, float $alpha)
    {

        parent::__construct($hue, $saturation, $lightness);;

        $this->alpha = MathUtil::capFloat($alpha);
    }

    public function withAlphaSupport(): AlphaColorInterface
    {

        return new self($this->hue, $this->saturation, $this->lightness, $this->alpha);
    }

    public function getRgba(): RgbaColorInterface
    {

        return $this->getRgb()->withAlphaSupport()->withAlpha($this->alpha);
    }

    public function getHsla(): HslaColorInterface
    {

        return new HslaColor($this->hue, $this->saturation, $this->lightness, $this->alpha);
    }

    public function getHsva(): HsvaColorInterface
    {

        return $this->getHsv()->withAlphaSupport()->withAlpha($this->alpha);
    }

    public function __toString()
    {

        return "hsla({$this->hue},{$this->saturation},{$this->lightness},{$this->alpha})";
    }
}