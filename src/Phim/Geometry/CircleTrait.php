<?php

namespace Phim\Geometry;

use Phim\GeometryTrait;

trait CircleTrait
{
    use GeometryTrait;

    private $radius = 0;

    /**
     * @return int
     */
    public function getRadius()
    {

        return $this->radius;
    }

    /**
     * @param int $radius
     *
     * @return $this
     */
    public function setRadius($radius)
    {

        $this->radius = $radius;

        return $this;
    }
}