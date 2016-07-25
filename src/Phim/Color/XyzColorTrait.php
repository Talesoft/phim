<?php

namespace Phim\Color;

use Phim\Util\MathUtil;

trait XyzColorTrait
{

    protected $x = 0;
    protected $y = 0;
    protected $z = 0;

    /**
     * @return int
     */
    public function getX()
    {

        return $this->x;
    }

    /**
     * @param int $x
     * @return $this
     */
    public function withX($x)
    {

        $color = clone $this;
        $color->x = MathUtil::capValue($x, 0, 100);
        return $color;
    }

    /**
     * @return int
     */
    public function getY()
    {

        return $this->y;
    }

    /**
     * @param int $y
     * @return $this
     */
    public function withY($y)
    {

        $color = clone $this;
        $color->y = MathUtil::capValue($y, 0, 100);
        return $color;
    }

    /**
     * @return int
     */
    public function getZ()
    {

        return $this->z;
    }

    /**
     * @param int $z
     * @return $this
     */
    public function withZ($z)
    {

        $color = clone $this;
        $color->z = MathUtil::capValue($z, 0, 100);
        return $color;
    }
}