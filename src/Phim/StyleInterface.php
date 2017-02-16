<?php

namespace Phim;

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
}