<?php

namespace Phim\Color;

use Phim\Color;
use Phim\ColorInterface;
use Phim\Exception\RuntimeException;

trait PaletteTrait
{

    private $colors;

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

        $color = Color::get($color);
        if (!($color instanceof ColorInterface))
            throw new RuntimeException(
                "The color you passed to PaletteTrait->offsetSet() is not valid"
            );

        if ($offset === null)
            $this->colors[] = $color;
        else
            $this->colors[$offset] = $color;
    }

    public function offsetUnset($offset)
    {

        unset($this->colors[$offset]);
    }
}