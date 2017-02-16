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

    /**
     * @return TransformationInterface[]
     */
    public function getTransformations();

    /**
     * @param TransformationInterface $transformation
     *
     * @return $this
     */
    public function addTransformation(TransformationInterface $transformation);

    /**
     * @param TransformationInterface $transformation
     *
     * @return $this
     */
    public function removeTransformation(TransformationInterface $transformation);

    /**
     * @return FilterInterface[]
     */
    public function getFilters();

    /**
     * @param FilterInterface $filter
     *
     * @return $this
     */
    public function addFilter(FilterInterface $filter);

    /**
     * @param FilterInterface $filter
     *
     * @return $this
     */
    public function removeFilter(FilterInterface $filter);
}