<?php

namespace Phim\Color\Scheme;

use Phim\Color;
use Phim\ColorInterface;

class MonochromaticScheme extends Color\SchemeBase
{

    private $tintScheme;
    private $shadeScheme;

    public function __construct($baseColor, $amount, $step)
    {

        $this->tintScheme = new TintScheme($baseColor, $amount, $step);
        $this->shadeScheme = new ShadeScheme($baseColor, $amount, $step);

        parent::__construct($baseColor);
    }

    /**
     * @return TintScheme
     */
    public function getTintScheme()
    {

        return $this->tintScheme;
    }

    /**
     * @return ShadeScheme
     */
    public function getShadeScheme()
    {

        return $this->shadeScheme;
    }

    /**
     * @param ColorInterface $baseColor
     * @return \Generator
     */
    protected function generate(ColorInterface $baseColor)
    {

        //First the shaded scheme in reverse order, excluding the last color
        for ($i = count($this->shadeScheme) - 1; $i > 0; $i--)
            yield $this->shadeScheme[$i];

        //Now all tints, including our base color
        foreach ($this->tintScheme as $color)
            yield $color;
    }
}