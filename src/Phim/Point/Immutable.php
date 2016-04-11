<?php

namespace Phim\Point;

class Immutable implements ImmutableInterface
{
    use ImmutableTrait;

    public function __construct($x, $y)
    {

        $this->x = $x;
        $this->y = $y;
    }
    
    public function mutate(callable $mutator)
    {
        
        $point = new Mutable($this->x, $this->y);
        $mutator($point);
        
        return $point->immutate();
    }
}