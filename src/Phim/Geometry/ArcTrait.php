<?php

namespace Phim\Geometry;

trait ArcTrait
{
    use EllipseTrait;

    private $startAngle = 0;
    private $endAngle = 360;

    /**
     * @return int
     */
    public function getStartAngle()
    {

        return $this->startAngle;
    }

    /**
     * @param int $startAngle
     *
     * @return ArcTrait
     */
    public function setStartAngle($startAngle)
    {

        $this->startAngle = $startAngle;

        return $this;
    }

    /**
     * @return int
     */
    public function getEndAngle()
    {

        return $this->endAngle;
    }

    /**
     * @param int $endAngle
     *
     * @return ArcTrait
     */
    public function setEndAngle($endAngle)
    {

        $this->endAngle = $endAngle;

        return $this;
    }
}