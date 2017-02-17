<?php

namespace Phim\Canvas;

use Phim\FilterInterface;
use Phim\ShapeInterface;
use Phim\TransformationInterface;

trait LayerTrait
{

    private $shapes = [];

    public function getShapes()
    {

        return $this->shapes;
    }

    public function add(ShapeInterface $shape)
    {

        $this->shapes[] = $shape;

        return $this;
    }

    public function remove(ShapeInterface $shape)
    {

        $this->shapes = array_filter($this->shapes, function (ShapeInterface $s) use ($shape) {

            return $s !== $shape;
        });

        return $this;
    }
}