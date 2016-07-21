<?php

namespace Phim\Color\Scheme;

use Phim\Color;
use Phim\ColorInterface;

class ComplementaryScheme extends Color\SchemeBase
{

    /**
     * @param ColorInterface $baseColor
     * @return \Generator
     */
    protected function generate(ColorInterface $baseColor)
    {

        yield $baseColor;
        yield Color::complement($baseColor);
    }
}