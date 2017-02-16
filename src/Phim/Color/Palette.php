<?php

namespace Phim\Color;

use Phim\Color;
use Phim\ColorInterface;

class Palette implements PaletteInterface
{
    use PaletteTrait;

    /**
     * constructor.
     *
     * @param int                $maxSize
     * @param \Traversable|array $colors
     */
    public function __construct($colors = null, $maxSize = null)
    {

        $this->setMaxSize($maxSize);

        if ($colors) {
            foreach ($colors as $color) {
                $this[] = $color;
            }
        }
    }

    public static function merge(PaletteInterface $palette, PaletteInterface $mergePalette, $prepend = false)
    {
        
        $paletteColors = $palette->getColors();
        $mergePaletteColors = $mergePalette->getColors();
        $totalCount = count($paletteColors) + count($mergePaletteColors);
        
        return new Color\Palette(
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

        return new Color\Palette(new \CallbackFilterIterator($filter($palette), $filterCallback));
    }

    public static function filterByHueRange(PaletteInterface $palette, $hueRange)
    {

        return self::filter($palette, function(ColorInterface $color) use ($hueRange) {

            return Color::isColorHueRange($color, $hueRange);
        });
    }

    public static function filterSimilarColors(PaletteInterface $palette, $requiredDifference = null)
    {

        $requiredDifference = $requiredDifference ?: 8;
        
        $distinctColors = [];
        foreach ($palette as $color) {

            $exists = false;
            foreach ($distinctColors as $dColor) {

                if (Color::equals($color, $dColor, $requiredDifference)) {

                    $exists = true;
                    break;
                }
            }

            if (!$exists)
                $distinctColors[] = $color;
        }

        return new Color\Palette($distinctColors);
    }

    public static function toHtml(PaletteInterface $palette, $columns = null, $width = null, $height = null)
    {

        $html = '';
        foreach ($palette as $i => $color) {
            $html .= Color::toHtml($color, $width, $height);

            if ($columns !== null && ($i + 1) % $columns === 0)
                $html .= '<br>';
        }

        return $html;
    }
}