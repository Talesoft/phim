<?php

namespace Phim\Geometry;

use Phim\Path;

class Line implements LineInterface
{
    use LineTrait;
    
    public function __construct($x, $y, $toX, $toY)
    {

        $this->setX($x);
        $this->setY($y);
        $this->setToX($toX);
        $this->setToY($toY);
    }

    public function toPath()
    {

        return Path::fromPoints([
            $this,
            $this->getTo()
        ]);
    }
}