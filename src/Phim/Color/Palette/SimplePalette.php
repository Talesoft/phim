<?php

namespace Phim\Color\Palette;

use Phim\Color;
use Phim\Color\Palette;
use Phim\Color\PaletteInterface;
use Phim\Color\PaletteTrait;

class SimplePalette implements PaletteInterface
{
    use PaletteTrait { offsetSet as private paletteTraitOffsetSet; }

    private $size;

    /**
     * FixedPalette constructor.
     *
     * @param int $size
     * @param \Traversable|array $colors
     */
    public function __construct($colors = null, $size = null)
    {

        $this->colors = [];
        $this->size = $size;
        
        if ($colors)
            foreach ($colors as $color)
                $this[] = $color;
    }

    public function getSize()
    {

        return $this->size;
    }

    public function add(PaletteInterface $palette, $prepend = false)
    {

        return Palette::merge($this, $palette, $prepend);
    }

    public function offsetSet($offset, $color)
    {

        if ($offset === null)
            $offset = $this->count();

        if ($this->size && $offset > $this->size - 1)
            throw new \OutOfBoundsException(
                "Tried to set offset $offset in a palette that fits only {$this->size} values"
            );

        $this->paletteTraitOffsetSet($offset, $color);
    }
}