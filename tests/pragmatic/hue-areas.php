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

foreach ($names as $name => $hex) {

    echo \Phim\color_to_html($hex);
    echo $name.' => '.\Phim\color_get_hue_range($hex);
    echo '<br>';
}
