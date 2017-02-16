<?php

namespace Phim;

/**
 * Interface ShapeInterface
 *
 * @package Phim
 */
interface ShapeInterface
{

    /**
     * @return PathInterface
     */
    public function getPath();

    /**
     * @return StyleInterface
     */
    public function getStyle();
}