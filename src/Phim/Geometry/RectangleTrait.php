<?php

namespace Phim\Geometry;

use Phim\Point\PointDataInterface;
use Phim\Size;

trait RectangleTrait
{

    protected $size = null;

    public function getSize()
    {

        return $this->size;
    }

    public function withSize(PointDataInterface $size)
    {

        $rect = clone $this;
        $rect->size = new Size($size->getX(), $size->getY());

        return $rect;
    }
}