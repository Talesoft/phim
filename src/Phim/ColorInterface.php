<?php

namespace Phim;

use Phim\Color\AlphaInterface;
use Phim\Color\HslaColorInterface;
use Phim\Color\HslColorInterface;
use Phim\Color\HsvaColorInterface;
use Phim\Color\HsvColorInterface;
use Phim\Color\RgbaColorInterface;
use Phim\Color\RgbColorInterface;

interface ColorInterface
{

    /** @return AlphaInterface */
    public function withAlphaSupport();
    /** @return ColorInterface */
    public function withoutAlphaSupport();

    /** @return RgbColorInterface */
    public function getRgb();
    /** @return RgbaColorInterface */
    public function getRgba();
    /** @return HslColorInterface */
    public function getHsl();
    /** @return HslaColorInterface */
    public function getHsla();
    /** @return HsvColorInterface */
    public function getHsv();
    /** @return HsvaColorInterface */
    public function getHsva();

    public function __toString();
}