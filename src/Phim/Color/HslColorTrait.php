<?php
declare(strict_types=1);

namespace Phim\Color;

trait HslColorTrait
{
    use HsColorTrait;

    protected $lightness = 0.0;

    /**
     * @return float
     */
    public function getLightness(): float
    {

        return $this->lightness;
    }

    /**
     * @param float $lightness
     * @return $this|HslColorInterface
     */
    public function withLightness(float $lightness): HslColorInterface
    {

        $color = clone $this;
        $color->lightness = $lightness;
        
        return $color;
    }
}