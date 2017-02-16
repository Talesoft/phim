<?php

namespace Phim\Geometry;

use Phim\GeometryInterface;
use Phim\PointInterface;

interface LineInterface extends GeometryInterface
{

    public function getToX();
    public function setToX($x);
    public function getToY();
    public function setToY($y);
    public function getTo();
    public function setTo(PointInterface $point);
    public function getDistance();
}