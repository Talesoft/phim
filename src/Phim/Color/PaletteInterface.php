<?php

namespace Phim\Color;

use Phim\Color\Palette\SimplePalette;
use Phim\ColorInterface;

interface PaletteInterface extends \ArrayAccess, \IteratorAggregate, \Countable
{

    /**
     * @return ColorInterface[]
     */
    public function getColors();

    /**
     * @param PaletteInterface $palette
     * @param bool $prepend
     * @return PaletteInterface
     */
    public function add(PaletteInterface $palette, $prepend = false);
}