<?php

namespace Phim\Color\Scheme;

use Phim\Color;

class NamedMonochromaticScheme extends MonochromaticScheme
{


    public function __construct($baseColor, $step)
    {

        parent::__construct($baseColor, 3, $step);
    }

    public function getDarkestShade()
    {

        return $this[0];
    }

    public function getDarkerShade()
    {

        return $this[1];
    }

    public function getDarkShade()
    {

        return $this[2];
    }

    public function getLightTint()
    {

        return $this[4];
    }

    public function getLighterTint()
    {

        return $this[5];
    }

    public function getLightestTint()
    {

        return $this[6];
    }
}