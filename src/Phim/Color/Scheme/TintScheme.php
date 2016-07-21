<?php

namespace Phim\Color\Scheme;

use Phim\Color;
use Phim\ColorInterface;

class TintScheme extends ContinousSchemeBase
{

    protected function generateStep(ColorInterface $baseColor, $i, $step)
    {

        return Color::lighten($baseColor, $i * $step);
    }
}