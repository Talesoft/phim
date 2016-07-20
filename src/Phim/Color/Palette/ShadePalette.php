<?php

namespace Phim\Color\Palette;

use Phim\Color;

class ShadePalette extends GeneratedPaletteBase
{
    
    private $baseColor;
    private $range;
    private $step;

    public function __construct($baseColor, $range = null, $step = null)
    {

        $this->baseColor = Color::get($baseColor);
        $this->range = $range ?: 2;
        $this->step = $step ?: .14;

        parent::__construct();
    }

    protected function generate()
    {

        for ($i = -$this->range; $i <= $this->range; $i++) {

            if ($i === 0) {

                yield $this->baseColor;
                continue;
            }

            $ratio = $i * $this->step;
            yield Color::lighten($this->baseColor, $ratio);
        }
    }
}