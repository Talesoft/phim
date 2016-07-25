<?php

include '../../vendor/autoload.php';

$names = array_replace([
    'fullred' => '#f00',
    'fullgreen' => '#0f0',
    'fullblue' => '#00f',
    'fullyellow' => '#ff0',
    'fullcyan' => '#0ff',
    'fullmagenta' => '#f0f'
], \Phim\color_get_names());

echo '<div style="white-space: nowrap;">';
foreach ($names as $name => $hex) {

    $color = \Phim\color_get($hex);
    echo \Phim\color_get_html($color, 80, 80);
    foreach ($names as $compareName => $compareHex) {

        $compareColor = \Phim\color_get($compareHex);
        echo '<div style="display: inline-block; vertical-align: top; text-align: center;">';
        echo \Phim\color_get_html($compareHex, 80, 80);
        echo '<br>';
        echo '<span style="padding: 10px;">'.\Phim\Color::getDifference($color, $compareColor).'</span>';
        echo '</div>';
    }

    echo '<br>';
}
echo '</div>';
