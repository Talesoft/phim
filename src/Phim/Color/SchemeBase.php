<?php

namespace Phim\Color;

use Phim\Color;
use Phim\Color\Palette\SimplePalette;
use Phim\ColorInterface;

abstract class SchemeBase extends SimplePalette
{
    use SchemeTrait;

    public function __construct($baseColor)
    {

        $this->baseColor = Color::get($baseColor);
        $colors = iterator_to_array($this->generate($this->baseColor));
        parent::__construct($colors, count($colors));
    }

    /**
     * @param ColorInterface $baseColor
     * @return \Generator
     */
    abstract protected function generate(ColorInterface $baseColor);
}