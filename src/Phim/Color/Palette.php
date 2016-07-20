<?php

namespace Phim\Color;

use Phim\Color;

class Palette implements PaletteInterface
{
    use PaletteTrait;

    /**
     * Palette constructor.
     *
     * @param \Traversable|array $colors
     */
    public function __construct($colors = null)
    {

        $this->colors = [];

        if ($colors)
            foreach ($colors as $color)
                $this[] = $color;
    }

    public static function getHtml(PaletteInterface $palette, $columns = null)
    {

        $html = '';
        foreach ($palette as $i => $color) {
            $html .= Color::getHtml($color);

            if ($columns !== null && ($i + 1) % $columns === 0)
                echo '<br>';
        }

        return $html;
    }
}