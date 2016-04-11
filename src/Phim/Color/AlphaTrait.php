<?php

namespace Phim\Color;

trait AlphaTrait
{

    protected $alpha = 1.0;

    /**
     * @return float
     */
    public function getAlpha()
    {

        return $this->alpha;
    }

    /**
     * @param float $alpha
     * @return $this
     */
    public function withAlpha($alpha)
    {

        $color = clone $this;
        $color->alpha = $alpha;
        return $this;
    }
}