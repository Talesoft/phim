<?php

use Phim\Color\RgbColor;

include '../../vendor/autoload.php';

function div(\Phim\ColorInterface $color)
{

    echo '<div style="width: 100px; font-size: 14px; height: 100px; float: left; background: '.$color.'">'.$color.'</div>';
}

for ($r = 0; $r < 255; $r += 20) {
    for ($g = 0; $g < 255; $g += 20) {
        for ($b = 0; $b < 255; $b += 20) {

            $rgb = new RgbColor($r, $g, $b);

            $cmyk = $rgb->getCmyk();
            $hsl = $rgb->getHsl();
            $hsv = $rgb->getHsv();

            div($rgb);
            div($cmyk);
            div($hsl->getRgb());
            div($hsv);
            echo '<br style="clear: both">';
        }
    }
}
