<?php

namespace Phim\Color\Scheme;

use Phim\Color;
use Phim\ColorInterface;

class SquareScheme extends Color\SchemeBase
{

    /**
     * @param ColorInterface $baseColor
     * @return \Generator
     */
    protected function generate(ColorInterface $baseColor)
    {

        yield $baseColor;
        yield Color::complement($baseColor, 90);
        yield Color::complement($baseColor, 180);
        yield Color::complement($baseColor, -90);
    }
}