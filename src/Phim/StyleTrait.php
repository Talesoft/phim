<?php

namespace Phim;

/**
 * Class StyleTrait
 *
 * @package Phim
 */
trait StyleTrait
{

    /**
     * @var null
     */
    private $strokeColor = null;
    /**
     * @var int
     */
    private $strokeWidth = 1;

    /**
     * @var null
     */
    private $fillColor = null;

    /**
     * @var TransformationInterface[]
     */
    private $transformations = [];

    /**
     * @var FilterInterface[]
     */
    private $filters = [];

    /**
     * @var PointInterface
     */
    private $transformOrigin = null;

    /**
     * @return mixed
     */
    public function getStrokeColor()
    {

        return $this->strokeColor;
    }

    /**
     * @param ColorInterface|null $strokeColor
     *
     * @return $this
     */
    public function setStrokeColor(ColorInterface $strokeColor)
    {

        $this->strokeColor = $strokeColor;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStrokeWidth()
    {

        return $this->strokeWidth;
    }

    /**
     * @param int $strokeWidth
     *
     * @return $this
     */
    public function setStrokeWidth($strokeWidth)
    {

        $this->strokeWidth = $strokeWidth;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFillColor()
    {

        return $this->fillColor;
    }

    /**
     * @param ColorInterface|null $fillColor
     *
     * @return $this
     */
    public function setFillColor(ColorInterface $fillColor)
    {

        $this->fillColor = $fillColor;

        return $this;
    }

    /**
     * @return TransformationInterface[]
     */
    public function getTransformations()
    {

        return $this->transformations;
    }

    /**
     * @param TransformationInterface $transformation
     *
     * @return $this
     */
    public function addTransformation(TransformationInterface $transformation)
    {

        $this->transformations[] = $transformation;

        return $this;
    }

    /**
     * @param TransformationInterface $transformation
     *
     * @return $this
     */
    public function removeTransformation(TransformationInterface $transformation)
    {

        $this->transformations = array_filter($this->transformations, function (TransformationInterface $t) use ($transformation) {

            return $t !== $transformation;
        });

        return $this;
    }

    /**
     * @return PointInterface|null
     */
    public function getTransformOrigin()
    {

        return $this->transformOrigin;
    }

    /**
     * @param PointInterface $origin
     *
     * @return StyleTrait
     */
    public function setTransformOrigin(PointInterface $origin)
    {

        $this->transformOrigin = $origin;

        return $this;
    }

    /**
     * @return FilterInterface[]
     */
    public function getFilters()
    {

        return $this->filters;
    }

    /**
     * @param FilterInterface $filter
     *
     * @return $this
     */
    public function addFilter(FilterInterface $filter)
    {

        $this->filters[] = $filter;

        return $this;
    }

    /**
     * @param FilterInterface $filter
     *
     * @return $this
     */
    public function removeFilter(FilterInterface $filter)
    {

        $this->filters = array_filter($this->filters, function (FilterInterface $f) use ($filter) {

            return $f !== $filter;
        });

        return $this;
    }
}