<?php

namespace Phim\Color\Scheme;

use Phim\Color;
use Phim\ColorInterface;

class AnalogousScheme extends Color\SchemeBase
{

    /**
     * @param ColorInterface $baseColor
     * @return \Generator
     */
    protected function generate(ColorInterface $baseColor)
    {

        yield Color::complement($baseColor, -30);
        yield $baseColor;
        yield Color::complement($baseColor, 30);
    }
}