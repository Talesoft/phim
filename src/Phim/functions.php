<?php

namespace Phim;

/**
 * @param $color
 * @return ColorInterface|null
 */
function color_get($color)
{

    return $color instanceof ColorInterface ? $color : Color::fromString((string)$color);
}

function color_register($name, $hexString)
{

    Color::register($name, $hexString);
}

function color_get_hex($color)
{

    return Color::getHexString(color_get($color));
}

function color_mix($color, $mixColor)
{

    return Color::mix(color_get($color), color_get($mixColor));
}