<?php

namespace Phim\Color;

use Phim\ColorInterface;

trait ColorizableTrait
{

    protected $color = null;

    public function getColor()
    {

        return $this->color;
    }

    public function setColor(ColorInterface $color)
    {

        $this->color = clone $color;

        return $this;
    }
}