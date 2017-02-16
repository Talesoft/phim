<?php

namespace Phim;

interface FilterInterface
{
    
    public function filterPixel($x, $y, ColorInterface $color);
}