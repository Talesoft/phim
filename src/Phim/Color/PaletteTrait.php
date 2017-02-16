<?php

namespace Phim\Color;

use Phim\Color;
use Phim\ColorInterface;
use Phim\Exception\RuntimeException;

trait PaletteTrait
{

    private $maxSize = null;
    private $colors = [];

    /**
     * @return int|null
     */
    public function getMaxSize()
    {

        return $this->maxSize;
    }

    /**
     * @param int|null $maxSize
     *
     * @return PaletteTrait
     */
    public function setMaxSize($maxSize)
    {

        $this->maxSize = $maxSize;

        return $this;
    }

    /**
     * @return ColorInterface[]
     */
    public function getColors()
    {

        return $this->colors;
    }

    public function getIterator()
    {

        foreach ($this->colors as $color)
            yield $color;
    }

    public function count()
    {

        return count($this->colors);
    }

    public function offsetExists($offset)
    {

        return isset($this->colors[$offset]);
    }

    public function offsetGet($offset)
    {

        return $this->colors[$offset];
    }

    public function offsetSet($offset, $color)
    {
        if ($offset === null)
            $offset = $this->count();

        if ($this->maxSize && $offset > $this->maxSize - 1)
            throw new \OutOfBoundsException(
                "Tried to set offset $offset in a palette that fits only {$this->size} values"
            );

        $color = Color::get($color);
        if (!($color instanceof ColorInterface))
            throw new RuntimeException(
                "The color you passed to PaletteTrait->offsetSet() is not valid"
            );

        $this->colors[$offset] = $color;
    }

    public function offsetUnset($offset)
    {

        unset($this->colors[$offset]);
    }
}