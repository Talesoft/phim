<?php

namespace Phim\Color;

use Phim\Color;
use Phim\Color\Palette\FixedPalette;
use Phim\ColorInterface;

abstract class SchemeBase extends FixedPalette
{
    use SchemeTrait;

    public function __construct($baseColor)
    {

        $this->baseColor = Color::get($baseColor);
        $colors = iterator_to_array($this->generate($this->baseColor));
        parent::__construct(count($colors), $colors);
    }

    /**
     * @param ColorInterface $baseColor
     * @return \Generator
     */
    abstract protected function generate(ColorInterface $baseColor);
}