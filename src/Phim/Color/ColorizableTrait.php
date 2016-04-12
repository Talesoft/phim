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

    public function withColor(ColorInterface $color)
    {

        $object = clone $this;
        $object->color = clone $color;
        return $object;
    }
}