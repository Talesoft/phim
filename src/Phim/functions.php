<?php

namespace Phim;

/**
 * @param mixed $color
 * @return ColorInterface|null
 */
function color_get($color)
{

    return Color::get($color);
}

function color_get_names()
{
    
    return Color::getNames();
}

function color_get_hue_ranges()
{

    return Color::getHueRanges();
}

function color_register_name($name, $hexString)
{

    Color::registerName($name, $hexString);
}

function color_get_hex($color)
{

    return Color::getHexString(color_get($color));
}

function color_get_min($color)
{
    
    return Color::getMin(color_get($color));
}

function color_get_max($color)
{
    
    return Color::getMax(color_get($color));
}

function color_get_avg($color)
{
    
    return Color::getAverage(color_get($color));
}

function color_get_hue_range($color)
{

    return Color::getColorHueRange(color_get($color));
}

function color_is_hue_range($color, $range)
{

    return Color::isColorHueRange(color_get($color), $range);
}

function color_mix($color, $mixColor)
{

    return Color::mix(color_get($color), color_get($mixColor));
}

function color_inverse($color)
{

    return Color::inverse(color_get($color));
}

function color_lighten($color, $ratio)
{

    return Color::lighten(color_get($color), $ratio);
}

function color_darken($color, $ratio)
{

    return Color::darken(color_get($color), $ratio);
}

function color_saturate($color, $ratio)
{

    return Color::saturate(color_get($color), $ratio);
}

function color_desaturate($color, $ratio)
{

    return Color::desaturate(color_get($color), $ratio);
}

function color_greyscale($color)
{

    return Color::greyscale(color_get($color));
}

function color_complement($color, $degrees = null)
{

    return Color::complement(color_get($color), $degrees);
}

function color_fade($color, $ratio)
{

    return Color::fade(color_get($color), $ratio);
}

function color_get_html($color)
{

    return Color::getHtml(color_get($color));
}

