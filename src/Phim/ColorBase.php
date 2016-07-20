<?php
declare(strict_types=1);

namespace Phim;

abstract class ColorBase implements ColorInterface
{

    public function inverse(): ColorInterface
    {

        return Color::inverse($this);
    }

    public function complement(int $degrees = null): ColorInterface
    {

        return Color::complement($this, $degrees);
    }

    public function lighten(float $ratio): ColorInterface
    {

        return Color::lighten($this, $ratio);
    }

    public function darken(float $ratio): ColorInterface
    {

        return Color::darken($this, $ratio);
    }

    public function saturate(float $ratio): ColorInterface
    {

        return Color::saturate($this, $ratio);
    }

    public function desaturate(float $ratio): ColorInterface
    {

        return Color::desaturate($this, $ratio);
    }

    public function greyscale(): ColorInterface
    {

        return Color::greyscale($this);
    }

    public function fade(float $ratio): ColorInterface
    {

        return Color::fade($this, $ratio);
    }
}