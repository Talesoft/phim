<?php

namespace Phim;

use Phim\Color\AlphaInterface;
use Phim\Color\LabColorInterface;
use Phim\Color\HslaColorInterface;
use Phim\Color\HslColorInterface;
use Phim\Color\HsvaColorInterface;
use Phim\Color\HsvColorInterface;
use Phim\Color\RgbaColorInterface;
use Phim\Color\RgbColorInterface;
use Phim\Color\XyzColorInterface;

interface ColorInterface
{

    /** @return AlphaInterface */
    public function toAlpha();
    /** @return ColorInterface */
    public function toOpaque();

    /** @return RgbColorInterface */
    public function toRgb();
    /** @return RgbaColorInterface */
    public function toRgba();
    /** @return HslColorInterface */
    public function toHsl();
    /** @return HslaColorInterface */
    public function toHsla();
    /** @return HsvColorInterface */
    public function toHsv();
    /** @return HsvaColorInterface */
    public function toHsva();

    /** @return XyzColorInterface */
    public function toXyz();

    /** @return LabColorInterface */
    public function toLab();

    public function __toString();
}