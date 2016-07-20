<?php

namespace Phim;

interface ShapeInterface extends DrawableInterface
{

    public function getGeometry();
    public function getBrush();
}