<?php

namespace Phim\Color;

use Phim\Color;
use Phim\ColorInterface;

class Palette
{

    public static function merge(PaletteInterface $palette, PaletteInterface $mergePalette, $prepend = false)
    {
        
        $paletteColors = $palette->getColors();
        $mergePaletteColors = $mergePalette->getColors();
        $totalCount = count($paletteColors) + count($mergePaletteColors);
        
        return new Color\Palette\SimplePalette(
            $prepend
                ? array_merge($mergePaletteColors, $paletteColors)
                : array_merge($paletteColors, $mergePaletteColors),
            $totalCount
        );
    }
    
    public static function filter(PaletteInterface $palette, callable $filterCallback)
    {

        $filter = function(PaletteInterface $palette) use ($filterCallback) {

            foreach ($palette as $i => $color)
                if ($filterCallback($color, $i))
                    yield $color;
        };

        return new Color\Palette\SimplePalette(new \CallbackFilterIterator($filter($palette), $filterCallback));
    }

    public static function filterByHueRange(PaletteInterface $palette, $hueRange)
    {

        return self::filter($palette, function(ColorInterface $color) use ($hueRange) {

            return Color::isColorHueRange($color, $hueRange);
        });
    }

    public static function filterDuplicates(PaletteInterface $palette, $tolerance = null, $ignoreAlpha = false)
    {

        $colors = $palette->getColors();
        return self::filter($palette, function(ColorInterface $color) use ($colors, $palette, $tolerance, $ignoreAlpha) {

            foreach ($colors as $paletteColor)
                if ($color !== $paletteColor && Color::equals($color, $paletteColor, $tolerance, $ignoreAlpha))
                    return false;

            return true;
        });
    }

    public static function getHtml(PaletteInterface $palette, $columns = null)
    {

        $html = '';
        foreach ($palette as $i => $color) {
            $html .= Color::getHtml($color);

            if ($columns !== null && ($i + 1) % $columns === 0)
                $html .= '<br>';
        }

        return $html;
    }
}