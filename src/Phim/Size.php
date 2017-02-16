<?php

namespace Phim;

class Size implements SizeInterface
{
    use SizeTrait;

    public function __construct($width, $height)
    {

        $this->setWidth($width);
        $this->setHeight($height);
    }
}