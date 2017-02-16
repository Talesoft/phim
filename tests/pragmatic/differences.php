<?php

use function Phim\color_get;

include '../../vendor/autoload.php';

$t = isset($_GET['t']) ? intval($_GET['t']) : 8;

$names = array_replace([
    'fullred' => '#f00',
    'fullgreen' => '#0f0',
    'fullblue' => '#00f',
    'fullyellow' => '#ff0',
    'fullcyan' => '#0ff',
    'fullmagenta' => '#f0f'
], [] /*\Phim\color_get_names()*/);

echo '<h1>Visually perceived difference in Colors (Monochromatic differences)</h1>';
echo '<div style="white-space: nowrap;">';
foreach ($names as $name => $hex) {

    $color = color_get($hex);
    echo \Phim\color_to_html($color);
    $mc = new \Phim\Color\Scheme\MonochromaticScheme($color, 8, .05);
    foreach ($mc as $compareColor) {

        echo '<div style="display: inline-block; vertical-align: top; text-align: center;">';
        echo \Phim\color_to_html($compareColor);
        echo '<br>';
        echo '<span style="padding: 10px;">'.\Phim\Color::getDifference($color, $compareColor).'</span>';
        echo '</div>';
    }

    echo '<br>';
}
echo '</div>';

echo '<h1>Visually perceived difference in Colors (Hue differences)</h1>';
echo '<div style="white-space: nowrap;">';
foreach ($names as $name => $hex) {

    $color = color_get($hex);
    echo \Phim\color_to_html($color);
    $mc = new \Phim\Color\Scheme\HueRotationScheme($color, 20, 5);
    foreach ($mc as $compareColor) {

        echo '<div style="display: inline-block; vertical-align: top; text-align: center;">';
        echo \Phim\color_to_html($compareColor);
        echo '<br>';
        echo '<span style="padding: 10px;">'.\Phim\Color::getDifference($color, $compareColor).'</span>';
        echo '</div>';
    }

    echo '<br>';
}
echo '</div>';

echo '<h1>Finding visually similar colors (Tolerance: '.$t.', control with &lt;url&gt;?t=&lt;tolerance&gt;)</h1>';
echo '<div style="white-space: nowrap;">';
foreach ($names as $name => $hex) {

    $color = color_get($hex);
    echo \Phim\color_to_html($color);
    foreach (\Phim\color_get_names() as $compareColor) {

        $deltaE = \Phim\Color::getDifference($color, color_get($compareColor));

        if ($deltaE < $t) {

            echo '<div style="display: inline-block; vertical-align: top; text-align: center;">';
            echo Phim\Color::toHtml(color_get($compareColor));
            echo '<br>';
            echo '<span style="padding: 10px;">'.$deltaE.'</span>';
            echo '</div>';
        }
    }

    echo '<br>';
}
echo '</div>';
