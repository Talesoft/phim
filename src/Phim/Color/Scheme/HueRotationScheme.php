<?php

namespace Phim\Color\Scheme;

use Phim\Color;
use Phim\ColorInterface;

class HueRotationScheme extends ContinousSchemeBase
{

    protected function generateStep(ColorInterface $baseColor, $i, $step)
    {

        return Color::complement($baseColor, $i * $step);
    }
}