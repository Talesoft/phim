<?php
declare(strict_types=1);

namespace Phim\Color;

interface AlphaInterface
{

    /**
     * @return float
     */
    public function getAlpha(): float;

    /**
     * @param float $alpha
     * @return $this|AlphaColorInterface
     */
    public function withAlpha(float $alpha): AlphaColorInterface;
}