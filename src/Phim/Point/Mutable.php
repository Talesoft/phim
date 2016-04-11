<?php

namespace Phim\Point;

class Mutable implements MutableInterface
{
    use MutableTrait;

    public function __construct($x, $y)
    {

        $this->x = $x;
        $this->y = $y;
    }

    public function immutate()
    {

        return new Immutable($this->x, $this->y);
    }
}