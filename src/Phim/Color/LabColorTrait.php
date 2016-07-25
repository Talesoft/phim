<?php

namespace Phim\Color;

use Phim\Util\MathUtil;

trait LabColorTrait
{

    protected $l = 0;
    protected $a = 0;
    protected $b = 0;

    /**
     * @return int
     */
    public function getL()
    {

        return $this->l;
    }

    /**
     * @param int $l
     * @return $this
     */
    public function withL($l)
    {

        $color = clone $this;
        $color->l = MathUtil::capValue($l, 0, 100);
        return $color;
    }

    /**
     * @return int
     */
    public function getA()
    {

        return $this->a;
    }

    /**
     * @param int $a
     * @return $this
     */
    public function withA($a)
    {

        $color = clone $this;
        $color->a = MathUtil::capValue($a, -128, 127);
        return $color;
    }

    /**
     * @return int
     */
    public function getB()
    {

        return $this->b;
    }

    /**
     * @param int $b
     * @return $this
     */
    public function withB($b)
    {

        $color = clone $this;
        $color->b = MathUtil::capValue($b, -128, 127);
        return $color;
    }
}