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
     *
     * @return $this
     */
    public function setX($x)
    {

        $this->x = MathUtil::capValue($x, 0, XyzColorInterface::REF_X);

        return $this;
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
     *
     * @return $this
     */
    public function setY($y)
    {

        $this->y = MathUtil::capValue($y, 0, XyzColorInterface::REF_Y);

        return $this;
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
     *
     * @return $this
     */
    public function setZ($z)
    {

        $this->z = MathUtil::capValue($z, 0, XyzColorInterface::REF_Z);

        return $this;
    }
}