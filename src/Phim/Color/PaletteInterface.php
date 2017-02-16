<?php

namespace Phim\Color;

use Phim\ColorInterface;

interface PaletteInterface extends \ArrayAccess, \IteratorAggregate, \Countable
{

    public function getMaxSize();

    /**
     * @return ColorInterface[]
     */
    public function getColors();
}