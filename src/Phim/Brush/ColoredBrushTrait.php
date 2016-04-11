<?php

namespace Phim\Brush;

use Phim\ColorInterface;

trait ColoredBrushTrait
{

    protected $color = null;

    public function getColor()
    {

        return $this->color;
    }

    public function withColor(ColorInterface $color)
    {

        $brush = clone $this;
        $brush->color = clone $color;
        return $brush;
    }
}