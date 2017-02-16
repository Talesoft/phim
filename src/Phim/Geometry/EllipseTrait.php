<?php

namespace Phim\Geometry;

use Phim\GeometryTrait;

trait EllipseTrait
{
    use GeometryTrait;

    private $radiusX = 0;
    private $radiusY = 0;

    /**
     * @return int
     */
    public function getRadiusX()
    {

        return $this->radiusX;
    }

    /**
     * @param int $radiusX
     *
     * @return $this
     */
    public function setRadiusX($radiusX)
    {

        $this->radiusX = $radiusX;

        return $this;
    }

    /**
     * @return int
     */
    public function getRadiusY()
    {

        return $this->radiusY;
    }

    /**
     * @param int $radiusY
     *
     * @return $this
     */
    public function setRadiusY($radiusY)
    {

        $this->radiusY = $radiusY;

        return $this;
    }
}