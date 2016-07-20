<?php
declare(strict_types=1);

namespace Phim;

function get_color(string $string): ColorInterface
{

    return Color::fromString($string);
}