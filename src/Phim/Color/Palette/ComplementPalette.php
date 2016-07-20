<?php

namespace Phim\Color\Palette;

use Phim\Color;

class ComplementPalette extends GeneratedPaletteBase
{

    private $baseColor;
    private $amount;

    public function __construct($baseColor, $amount = null)
    {

        $this->baseColor = Color::get($baseColor);
        $this->amount = $amount ?: 4;

        parent::__construct();
    }

    protected function generate()
    {

        yield $this->baseColor;
        $part = 360 / $this->amount;
        for ($i = 1; $i < $this->amount; $i++) {

            yield Color::complement($this->baseColor, $i * $part);
        }
    }
}