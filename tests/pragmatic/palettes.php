<?php

use Phim\Color\Palette;
use Phim\Color\Palette\ShadePalette;

include '../../vendor/autoload.php';

$sorter = function($a, $b) {

    return \Phim\color_get($a)->getHsl()->getLightness() <=> \Phim\color_get($b)->getHsl()->getLightness();
};

$colorNames = array_values(\Phim\color_get_names());
usort($colorNames, $sorter);

?><h1>Shades</h1><?php
foreach ($colorNames as $color) {

    $sp = new ShadePalette($color, 4, .1);
    echo Palette::getHtml($sp);
    echo '<br>';
}


?><h1>Complements</h1><?php
foreach ($colorNames as $color) {

    $cp = new Palette\ComplementPalette($color, 8);
    echo Palette::getHtml($cp);
    echo '<br>';
}