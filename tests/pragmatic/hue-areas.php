<?php


use Phim\Color;
use function Phim\color_get;
use function Phim\color_get_hex;
use Phim\ColorInterface;

include '../../vendor/autoload.php';

function div(ColorInterface $color)
{

    echo '<div style="width: 100px; font-size: 14px; height: 100px; float: left; background: '.$color.'">'.color_get_hex($color).'</div>';
}

$names = array_replace([
    'fullred' => '#f00',
    'fullgreen' => '#0f0',
    'fullblue' => '#00f',
    'fullyellow' => '#ff0',
    'fullcyan' => '#0ff',
    'fullmagenta' => '#f0f'
], Color::getNames());

foreach ($names as $name => $hex) {
    
    $color = color_get($hex);
    
    div($color);
    echo $name.' => '.Color::getHueArea($color->getHsl()->getHue());
    echo '<br style="clear: both">';
}
