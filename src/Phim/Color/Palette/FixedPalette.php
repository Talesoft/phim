<?php

namespace Phim\Color\Palette;

use Phim\Color\Palette;

abstract class FixedPalette extends Palette
{
    
    private $size;

    /**
     * FixedPalette constructor.
     *
     * @param int $size
     * @param \Traversable|array $colors
     */
    public function __construct($size, $colors = null)
    {

        $this->size = $size;

        parent::__construct($colors);
    }

    public function getSize()
    {

        return $this->size;
    }

    public function offsetSet($offset, $color)
    {

        if ($offset === null)
            $offset = $this->count();

        if ($offset > $this->size - 1)
            throw new \OutOfBoundsException(
                "Tried to set offset $offset in a palette that fits only {$this->size} values"
            );

        parent::offsetSet($offset, $color);
    }
}