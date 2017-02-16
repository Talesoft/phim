<?php

namespace Phim\Shape;

use Phim\GeometryInterface;
use Phim\ShapeTrait;

trait GeometricShapeTrait
{
    use ShapeTrait;

    /**
     * @var GeometryInterface
     */
    private $geometry = null;
    
    public function getGeometry()
    {

        return $this->geometry;
    }

    public function setGeometry(GeometryInterface $geometry)
    {

        $this->geometry = $geometry;

        return $this;
    }

    public function updatePath()
    {

        if (!$this->geometry)
            throw new \RuntimeException(
                "Failed to update path on shape: No underlying geometry provided"
            );

        $this->setPath($this->geometry->toPath());

        return $this;
    }
}