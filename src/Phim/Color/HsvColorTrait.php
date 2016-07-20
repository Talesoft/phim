<?php
declare(strict_types=1);

namespace Phim\Color;

trait HsvColorTrait
{
    use HsColorTrait;

    protected $value = 0.0;

    /**
     * @return float
     */
    public function getValue(): float
    {

        return $this->value;
    }

    /**
     * @param float $value
     * @return $this|HsvColorInterface
     */
    public function withValue(float $value): HsvColorInterface
    {

        $color = clone $this;
        $color->value = $value;

        return $color;
    }
}