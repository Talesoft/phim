<?php

namespace Phim\Color\Palette;

abstract class GeneratedPaletteBase extends FixedPalette
{

    public function __construct()
    {

        $colors = iterator_to_array($this->generate());
        parent::__construct(count($colors), $colors);
    }

    /**
     * @return \Generator
     */
    abstract protected function generate();
}