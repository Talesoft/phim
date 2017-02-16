<?php

namespace Phim\Color;

use Phim\Util\MathUtil;

trait AlphaTrait
{

    protected $alpha = 1.0;

    /**
     * @return float
     */
    public function getAlpha()
    {

        return $this->alpha;
    }

    /**
     * @param float $alpha
     * @return $this
     */
    public function setAlpha($alpha)
    {

        $this->alpha = MathUtil::capValue($alpha, 0.0, 1.0);

        return $this;
    }
}