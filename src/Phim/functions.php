<?php

namespace Phim;

use Phim\Color\Palette;
use Phim\Color\PaletteInterface;
use Phim\Color\Scheme\AnalogousScheme;
use Phim\Color\Scheme\ComplementaryScheme;
use Phim\Color\Scheme\HueRotationScheme;
use Phim\Color\Scheme\MonochromaticScheme;
use Phim\Color\Scheme\NamedMonochromaticScheme;
use Phim\Color\Scheme\ShadeScheme;
use Phim\Color\Scheme\SplitComplementaryScheme;
use Phim\Color\Scheme\SquareScheme;
use Phim\Color\Scheme\TetradicScheme;
use Phim\Color\Scheme\TintScheme;
use Phim\Color\Scheme\ToneScheme;
use Phim\Color\Scheme\TriadicScheme;

/** Color functions **/

/**
 * @return array
 */
function color_get_names()
{
    
    return Color::getNames();
}

function color_to_name($color) {

    return Color::toName(color_get($color));
}

function color_parse_name($string) {

    return Color::parseName($string);
}

function color_register_name($name, $color) {

    Color::registerName($name, color_get($color));
}

function color_to_hex_string($color, $expand = false) {

    return Color::toHexString(color_get($color), $expand);
}

function color_parse_hex_string($string) {

    return Color::parseHexString($string);
}

function color_parse_int($int) {

    return Color::parseInt($int);
}

function color_to_int($color) {

    return Color::toInt(color_get($color));
}

/**
 * @return array
 */
function color_get_functions()
{

    return Color::getFunctions();
}

function color_parse_function_string($string) {

    return Color::parseFunctionString($string);
}

/**
 * @param mixed $value
 *
 * @return ColorInterface
 */
function color_get($value) {

    return Color::get($value);
}

function color_get_max($color) {

    return Color::getMax(color_get($color));
}

function color_get_min($color) {

    return Color::getMin(color_get($color));
}

function color_get_average($color) {

    return Color::getAverage(color_get($color));
}

function color_get_hue_ranges()
{

    return Color::getHueRanges();
}

function color_get_hue_range($hue) {

    return Color::getHueRange($hue);
}

function color_is_hue_range($hue, $range) {

    return Color::isHueRange($hue, $range);
}

function color_get_color_hue_range($color) {

    return Color::getColorHueRange(color_get($color));
}

function color_is_color_hue_range($color, $range) {

    return Color::isColorHueRange(color_get($color), $range);
}

function color_mix($color, $mixColor) {

    return Color::mix(color_get($color), color_get($mixColor));
}

function color_inverse($color) {

    return Color::inverse(color_get($color));
}

function color_lighten($color, $ratio) {

    return Color::lighten(color_get($color), $ratio);
}

function color_darken($color, $ratio) {

    return Color::darken(color_get($color), $ratio);
}

function color_saturate($color, $ratio) {

    return Color::saturate(color_get($color), $ratio);
}

function color_desaturate($color, $ratio) {

    return Color::desaturate(color_get($color), $ratio);
}

function color_greyscale($color) {

    return Color::greyscale(color_get($color));
}

function color_complement($color, $degrees = null) {

    return Color::complement(color_get($color), $degrees);
}

function color_fade($color, $ratio) {

    return Color::fade(color_get($color), $ratio);
}

function color_get_difference($color, $compareColor) {

    return Color::getDifference(color_get($color), color_get($compareColor));
}

function color_equals($color, $compareColor, $tolerance = null) {

    return Color::equals(color_get($color), color_get($compareColor), $tolerance);
}

function color_to_html($color, $width = null, $height = null)
{

    return Color::toHtml(color_get($color), $width, $height);
}


/** Color\Palette functions **/

function color_palette_merge(PaletteInterface $palette, PaletteInterface $mergePalette)
{
    
    return Palette::merge($palette, $mergePalette);
}

function color_palette_filter_by_hue_range(PaletteInterface $palette, $hueRange)
{

    return Palette::filterByHueRange($palette, $hueRange);
}

function color_palette_filter_similar_colors(PaletteInterface $palette, $tolerance = null)
{

    return Palette::filterSimilarColors($palette, $tolerance);
}

function color_palette_get_html(PaletteInterface $palette, $columns = null, $width = null, $height = null)
{

    return Palette::toHtml($palette, $columns, $width, $height);
}

/** Color\Scheme functions **/

function color_scheme_analogous($baseColor)
{

    return new AnalogousScheme($baseColor);
}

function color_scheme_complementary($baseColor)
{

    return new ComplementaryScheme($baseColor);
}

function color_scheme_hue_rotation($baseColor, $amount, $step)
{

    return new HueRotationScheme($baseColor, $amount, $step);
}

function color_scheme_monochromatic($baseColor, $amount, $step)
{

    return new MonochromaticScheme($baseColor, $amount, $step);
}

function color_scheme_named_monochromatic($baseColor, $amount, $step)
{

    return new NamedMonochromaticScheme($baseColor, $step);
}

function color_scheme_shades($baseColor, $amount, $step)
{

    return new ShadeScheme($baseColor, $amount, $step);
}

function color_scheme_split_complementary($baseColor, $amount, $step)
{

    return new SplitComplementaryScheme($baseColor);
}

function color_scheme_tetradic($baseColor)
{

    return new TetradicScheme($baseColor);
}

function color_scheme_square($baseColor)
{

    return new SquareScheme($baseColor);
}

function color_scheme_tints($baseColor, $amount, $step)
{

    return new TintScheme($baseColor, $amount, $step);
}

function color_scheme_tones($baseColor, $amount, $step)
{

    return new ToneScheme($baseColor, $amount, $step);
}

function color_scheme_triadic($baseColor)
{

    return new TriadicScheme($baseColor);
}