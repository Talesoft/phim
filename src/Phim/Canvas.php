<?php

namespace Phim;

class Canvas implements CanvasInterface
{
    use CanvasTrait;

    public function __construct($width, $height)
    {

        $this->setWidth($width);
        $this->setHeight($height);
    }
}