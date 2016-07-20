<?php

use Phim\Color;
use Phim\Color\RgbColor;

include '../../vendor/autoload.php';

function div(\Phim\ColorInterface $color)
{

    echo '<div style="width: 100px; font-size: 14px; height: 100px; float: left; background: '.$color.'">'.Color::getHexString($color).'</div>';
}

for ($r = 0; $r < 255; $r += 20) {
    for ($g = 0; $g < 255; $g += 20) {
        for ($b = 0; $b < 255; $b += 20) {

            $rgb = new RgbColor($r, $g, $b);
            $rgba = $rgb->withAlphaSupport()->withAlpha(.5);
            $hsl = $rgb->getHsl();
            $hsla = $hsl->withAlphaSupport()->withAlpha(.5);
            $hsv = $rgb->getHsv();
            $hsva = $hsv->withAlphaSupport()->withAlpha(.5);

            div($rgb);
            div($rgba);
            div($hsl->getRgb());
            div($hsla->getRgba());
            div($hsv->getRgb());
            div($hsva->getRgba());
            echo '<br style="clear: both">';
        }
    }
}
