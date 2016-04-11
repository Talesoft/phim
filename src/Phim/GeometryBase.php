<?php

namespace Phim;

use Phim\Point\PointDataInterface;

abstract class GeometryBase extends Point implements GeometryInterface
{

    public function __construct(PointDataInterface $position)
    {

        parent::__construct($position->getX(), $position->getY());
    }
}