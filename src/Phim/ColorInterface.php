<?php
declare(strict_types=1);

namespace Phim;

use Phim\Color\AlphaColorInterface;
use Phim\Color\HslaColorInterface;
use Phim\Color\HslColorInterface;
use Phim\Color\HsvaColorInterface;
use Phim\Color\HsvColorInterface;
use Phim\Color\RgbaColorInterface;
use Phim\Color\RgbColorInterface;

interface ColorInterface
{

    public function withAlphaSupport(): AlphaColorInterface;
    public function withoutAlphaSupport(): ColorInterface;
    
    public function getRgb(): RgbColorInterface;
    public function getRgba(): RgbaColorInterface;
    public function getHsl(): HslColorInterface;
    public function getHsla(): HslaColorInterface;
    public function getHsv(): HsvColorInterface;
    public function getHsva(): HsvaColorInterface;

    public function inverse(): ColorInterface;
    public function complement(int $degrees = null): ColorInterface;
    public function lighten(float $ratio): ColorInterface;
    public function darken(float $ratio): ColorInterface;
    public function saturate(float $ratio): ColorInterface;
    public function desaturate(float $ratio): ColorInterface;
    public function greyscale(): ColorInterface;
    public function fade(float $ratio): ColorInterface;

    public function __toString();
}