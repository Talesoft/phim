<?php

use Phim\Color;
use function Phim\color_to_html;
use function Phim\color_get_hue_ranges;
use function Phim\color_mix;

include '../../vendor/autoload.php';

?>


<h1>Mixing</h1>
<?php
$mixes = [
    ['red', 'blue'],
    ['green', 'magenta'],
    ['cyan', 'yellow'],
    ['black', 'white'],
    ['black', 'red'],
    ['white', 'blue'],
    ['red', 'blue'],
    ['#f00a', '#00fa'],
    ['#f00a', '#00f'],
    ['#f00a', '#00ff']
];
?>
<table>
    <tr>
        <td>Color</td>
        <td>Mix Color</td>
        <td>Result</td>
    </tr>
    <?php foreach ($mixes as $mix): ?>
        <tr>
            <td><?=color_to_html($mix[0])?></td>
            <td><?=color_to_html($mix[1])?></td>
            <td><?=color_to_html(color_mix($mix[0], $mix[1]))?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h1>Inverse</h1>
<table>
    <tr>
        <td>Color</td>
        <td>Result</td>
    </tr>
    <?php foreach (color_get_hue_ranges() as $color): ?>
        <tr>
            <td><?=color_to_html($color)?></td>
            <td><?=color_to_html(\Phim\color_inverse($color))?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h1>Complement</h1>
<table>
    <tr>
        <td>Color</td>
        <td>180° (Opposite)</td>
        <td>90°</td>
        <td>270°</td>
    </tr>
    <?php foreach (color_get_hue_ranges() as $color): ?>
        <tr>
            <td><?=color_to_html($color)?></td>
            <td><?=color_to_html(\Phim\color_complement($color))?></td>
            <td><?=color_to_html(\Phim\color_complement($color, 90))?></td>
            <td><?=color_to_html(\Phim\color_complement($color, 270))?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h1>Lighten</h1>
<table>
    <tr>
        <td>Color</td>
        <td>Result</td>
    </tr>
    <?php foreach (color_get_hue_ranges() as $color): ?>
        <tr>
            <td><?=color_to_html($color)?></td>
            <td><?=color_to_html(\Phim\color_lighten($color, .2))?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h1>Darken</h1>
<table>
    <tr>
        <td>Color</td>
        <td>Result</td>
    </tr>
    <?php foreach (color_get_hue_ranges() as $color): ?>
        <tr>
            <td><?=color_to_html($color)?></td>
            <td><?=color_to_html(\Phim\color_darken($color, .2))?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h1>Saturate</h1>
<table>
    <tr>
        <td>Color</td>
        <td>Result</td>
    </tr>
    <?php foreach (array_map(function($c) { return \Phim\color_desaturate($c, .8); }, color_get_hue_ranges()) as $color): ?>
        <tr>
            <td><?=color_to_html($color)?></td>
            <td><?=color_to_html(\Phim\color_saturate($color, .4))?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h1>Desaturate</h1>
<table>
    <tr>
        <td>Color</td>
        <td>Result</td>
    </tr>
    <?php foreach (color_get_hue_ranges() as $color): ?>
        <tr>
            <td><?=color_to_html($color)?></td>
            <td><?=color_to_html(\Phim\color_desaturate($color, .6))?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h1>Greyscale</h1>
<table>
    <tr>
        <td>Color</td>
        <td>Result</td>
    </tr>
    <?php foreach (color_get_hue_ranges() as $color): ?>
        <tr>
            <td><?=color_to_html($color)?></td>
            <td><?=color_to_html(\Phim\color_greyscale($color))?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h1>Fade</h1>
<table>
    <tr>
        <td>Color</td>
        <td>Result</td>
    </tr>
    <?php foreach (color_get_hue_ranges() as $color): ?>
        <tr>
            <td><?=color_to_html($color)?></td>
            <td><?=color_to_html(\Phim\color_fade($color, .4))?></td>
        </tr>
    <?php endforeach; ?>
</table>