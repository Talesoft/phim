<?php

namespace Phim\Canvas;

use Phim\FilterInterface;
use Phim\ShapeInterface;
use Phim\TransformationInterface;

/**
 * Interface LayerInterface
 *
 * @package Phim\Canvas
 */
interface LayerInterface
{

    /**
     * @return ShapeInterface[]
     */
    public function getShapes();

    /**
     * @param ShapeInterface $shape
     *
     * @return $this
     */
    public function add(ShapeInterface $shape);

    /**
     * @param ShapeInterface $shape
     *
     * @return $this
     */
    public function remove(ShapeInterface $shape);
}