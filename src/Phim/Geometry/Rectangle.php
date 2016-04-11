<?php

namespace Phim\Geometry;

use Phim\GeometryBase;
use Phim\Point\PointDataInterface;
use Phim\Size;

class Rectangle extends GeometryBase implements RectangleInterface
{
    use RectangleTrait;
        
    public function __construct(PointDataInterface $position, PointDataInterface $size)
    {
        
        parent::__construct($position);
        
        $this->size = new Size($size->getX(), $size->getY());
    }
}