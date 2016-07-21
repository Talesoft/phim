<?php

namespace Phim\Color\Scheme;

use Phim\Color;
use Phim\ColorInterface;

class ToneScheme extends ContinousSchemeBase
{

    protected function generateStep(ColorInterface $baseColor, $i, $step)
    {

        return Color::desaturate($baseColor, $i * $step);
    }
}