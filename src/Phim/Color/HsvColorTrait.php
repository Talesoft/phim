<?php

namespace Phim\Color;

trait HsvColorTrait
{
    use HsColorTrait;

    protected $value = 0;

    /**
     * @return int
     */
    public function getValue()
    {

        return $this->value;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function withValue($value)
    {

        $color = clone $this;
        $color->value = $value;
        return $this;
    }
}