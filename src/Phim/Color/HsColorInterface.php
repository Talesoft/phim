<?php
declare(strict_types=1);

namespace Phim\Color;

use Phim\ColorInterface;

interface HsColorInterface extends ColorInterface
{

    public function getHue(): int;
    public function withHue(int $hue): HsColorInterface;

    public function getSaturation(): float;
    public function withSaturation(float $saturation): HsColorInterface;
}