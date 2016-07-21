<?php

namespace Phim\Color\Scheme;

use Phim\Color;
use Phim\ColorInterface;

class ShadeScheme extends ContinousSchemeBase
{

    protected function generateStep(ColorInterface $baseColor, $i, $step)
    {

        return Color::darken($baseColor, $i * $step);
    }
}