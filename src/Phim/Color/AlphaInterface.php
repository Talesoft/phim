<?php

namespace Phim\Color;

interface AlphaInterface
{

    /**
     * @return float
     */
    public function getAlpha();

    /**
     * @param float $alpha
     * @return $this
     */
    public function setAlpha($alpha);
}