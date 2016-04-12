<?php

namespace Phim\Engine\Context;

use Phim\DrawableInterface;
use Phim\Engine\ContextInterface;
use Phim\TransformationInterface;

interface DrawContextInterface extends ContextInterface
{

    public function getCanvasContext();
    public function getCanvas();

    public function getLayer();

    public function getDrawableContext(DrawableInterface $drawable);
    public function drawDrawable(DrawableContextInterface $drawableContext);
    public function draw();

    public function getTransformationContext(TransformationInterface $transformation);
    public function applyTransformation(TransformationContextInterface $transformationContext);
    public function transform();

    public function getFilterContext(FilterInterface $filter);
    public function applyFilter(FilterContextInterface $filterContext);
    public function filter();
}