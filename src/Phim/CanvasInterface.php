<?php

namespace Phim;

use Phim\Point\PointDataInterface;

interface CanvasInterface
{

    //Property management
    public function getBackgroundColor();
    public function setBackgroundColor(ColorInterface $color);
    public function getSize();
    public function setSize(PointDataInterface $size);

    //Drawing management
    public function getDrawables();
    public function getTransformations();
    public function getFilters();

    public function draw(DrawableInterface $drawable);
    public function erase(DrawableInterface $drawable);
    public function transform(TransformationInterface $transformation);
    public function filter(FilterInterface $filter);

    //Layer management
    public function getLayers();
    public function hasLayer($name);
    public function getLayer($name);
    public function setLayer($name, CanvasInterface $layer);
    public function getFirstLayer();
    public function getLastLayer();
    public function createLayer($name);
}