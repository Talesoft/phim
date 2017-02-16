<?php

namespace Phim\Canvas;

use Phim\FilterInterface;
use Phim\ShapeInterface;
use Phim\TransformationInterface;

trait LayerTrait
{

    private $shapes = [];
    private $transformations = [];
    private $filters = [];

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

    public function getTransformations()
    {

        return $this->transformations;
    }

    public function addTransformation(TransformationInterface $transformation)
    {

        $this->transformations[] = $transformation;

        return $this;
    }

    public function removeTransformation(TransformationInterface $transformation)
    {

        $this->transformations = array_filter($this->transformations, function (TransformationInterface $t) use ($transformation) {

            return $t !== $transformation;
        });

        return $this;
    }

    public function getFilters()
    {

        return $this->filters;
    }

    public function addFilter(FilterInterface $filter)
    {

        $this->filters[] = $filter;

        return $this;
    }

    public function removeFilter(FilterInterface $filter)
    {

        $this->filters = array_filter($this->filters, function (FilterInterface $f) use ($filter) {

            return $f !== $filter;
        });

        return $this;
    }
}