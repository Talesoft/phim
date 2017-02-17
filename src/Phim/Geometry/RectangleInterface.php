<?php

namespace Phim\Geometry;

use Phim\GeometryInterface;
use Phim\Point\PointDataInterface;
use Phim\PointInterface;
use Phim\SizeInterface;

interface RectangleInterface extends GeometryInterface, SizeInterface
{

    public function getLeft();
    public function setLeft($left);
    public function getTop();
    public function setTop($top);
    public function getRight();
    public function setRight($right);
    public function getBottom();
    public function setBottom($bottom);
    
    public function getLeftTop();
    public function setLeftTop(PointInterface $leftTop);
    public function getRightTop();
    public function setRightTop(PointInterface $rightTop);
    public function getRightBottom();
    public function setRightBottom(PointInterface $rightBottom);
    public function getLeftBottom();
    public function setLeftBottom(PointInterface $leftBottom);

    public function getCenter();
}