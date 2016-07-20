<?php
declare(strict_types=1);

namespace Phim\Color;

use Phim\Util\MathUtil;

class HsvaColor extends HsvColor implements HsvaColorInterface
{
    use HsvaColorTrait;

    public function __construct(int $hue, float $saturation, float $value, float $alpha)
    {

        parent::__construct($hue, $saturation, $value);;

        $this->alpha = MathUtil::capFloat($alpha);
    }

    public function withAlphaSupport(): AlphaColorInterface
    {

        return new self($this->hue, $this->saturation, $this->value, $this->alpha);
    }

    public function getRgba(): RgbaColorInterface
    {

        return $this->getRgb()->withAlphaSupport()->withAlpha($this->alpha);
    }

    public function getHsla(): HslaColorInterface
    {

        return $this->getHsv()->withAlphaSupport()->withAlpha($this->alpha);
    }

    public function getHsva(): HsvaColorInterface
    {

        return new HslaColor($this->hue, $this->saturation, $this->value, $this->alpha);
    }

    public function __toString()
    {

        return "hsva({$this->hue},{$this->saturation},{$this->value},{$this->alpha})";
    }
}