<?php

namespace Phim\Color;

trait SchemeTrait
{
    use PaletteTrait;

    private $baseColor;

    public function getBaseColor()
    {

        return $this->baseColor;
    }
}