<?php

namespace Phim\Geometry;

use Phim\GeometryTrait;
use Phim\Path;
use Phim\Point;
use Phim\PointInterface;
use Phim\SizeTrait;

trait RectangleTrait
{
    use GeometryTrait, SizeTrait;

    public function getLeft()
    {

        return $this->getX();
    }

    public function setLeft($left)
    {

        $this->setWidth($this->getWidth() - ($left - $this->getLeft()));
        $this->setX($left);

        return $this;
    }

    public function getTop()
    {

        return $this->getY();
    }

    public function setTop($top)
    {

        $this->setHeight($this->getHeight() - ($top - $this->getTop()));
        $this->setY($top);

        return $this;
    }

    public function getRight()
    {

        return $this->getX() + $this->getWidth();
    }

    public function setRight($right)
    {

        $this->setWidth($this->getWidth() - ($right - $this->getRight()));

        return $this;
    }

    public function getBottom()
    {

        return $this->getY() + $this->getHeight();
    }

    public function setBottom($bottom)
    {

        $this->setHeight($this->getHeight() - ($bottom - $this->getBottom()));

        return $this;
    }

    public function getLeftTop()
    {

        return new Point($this->getLeft(), $this->getTop());
    }

    public function setLeftTop(PointInterface $leftTop)
    {

        $this->setLeft($leftTop->getX());
        $this->setTop($leftTop->getY());

        return $this;
    }

    public function getRightTop()
    {

        return new Point($this->getRight(), $this->getTop());
    }

    public function setRightTop(PointInterface $rightTop)
    {

        $this->setRight($rightTop->getX());
        $this->setTop($rightTop->getY());

        return $this;
    }

    public function getRightBottom()
    {

        return new Point($this->getRight(), $this->getBottom());
    }

    public function setRightBottom(PointInterface $rightBottom)
    {

        $this->setRight($rightBottom->getX());
        $this->setBottom($rightBottom->getY());

        return $this;
    }

    public function getLeftBottom()
    {

        return new Point($this->getLeft(), $this->getBottom());
    }

    public function setLeftBottom(PointInterface $leftBottom)
    {

        $this->setLeft($leftBottom->getX());
        $this->setBottom($leftBottom->getY());

        return $this;
    }

    public function getCenter()
    {

        return new Point($this->getX() + $this->getWidth() / 2, $this->getY() + $this->getHeight() / 2);
    }

    public function toPath()
    {

        return Path::fromPoints([
            $this->getLeftTop(),
            $this->getRightTop(),
            $this->getRightBottom(),
            $this->getLeftBottom()
        ]);
    }
}