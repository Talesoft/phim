<?php

namespace Phim;

/**
 * Interface StyleInterface
 *
 * @package Phim
 */
/**
 * Interface StyleInterface
 *
 * @package Phim
 */
interface StyleInterface
{

    /**
     * @return ColorInterface
     */
    public function getStrokeColor();

    /**
     * @param ColorInterface $color
     *
     * @return mixed
     */
    public function setStrokeColor(ColorInterface $color);

    /**
     * @return int
     */
    public function getStrokeWidth();

    /**
     * @param $width
     *
     * @return mixed
     */
    public function setStrokeWidth($width);

    /**
     * @return ColorInterface
     */
    public function getFillColor();

    /**
     * @param ColorInterface $color
     *
     * @return mixed
     */
    public function setFillColor(ColorInterface $color);

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
     * @return PointInterface
     */
    public function getTransformOrigin();

    /**
     * @param PointInterface $origin
     *
     * @return $this
     */
    public function setTransformOrigin(PointInterface $origin);

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