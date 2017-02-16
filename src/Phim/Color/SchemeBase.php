<?php

namespace Phim\Color;

use Phim\Color;
use Phim\ColorInterface;

abstract class SchemeBase implements SchemeInterface
{
    use SchemeTrait;


    /**
     * SchemeBase constructor.
     * @param ColorInterface|string|int $baseColor
     */
    public function __construct($baseColor)
    {

        $this->baseColor = Color::get($baseColor);

        foreach ($this->generate($this->baseColor) as $color) {

            $this[] = $color;
        }
    }

    /**
     * @param ColorInterface $baseColor
     * @return \Generator
     */
    abstract protected function generate(ColorInterface $baseColor);
}