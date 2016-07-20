<?php
declare(strict_types=1);

namespace Phim\Color;

interface HslColorInterface extends HsColorInterface
{

    public function getLightness(): float;
    public function withLightness(float $lightness): HslColorInterface;
}