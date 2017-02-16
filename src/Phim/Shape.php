<?php

namespace Phim;

class Shape implements ShapeInterface
{
    use ShapeTrait;

    public function __construct(PathInterface $path, StyleInterface $style = null)
    {

        $this->setPath($path);
        $this->setStyle($style);
    }
}