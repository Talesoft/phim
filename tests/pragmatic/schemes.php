<?php

use Phim\Color\Palette;
use Phim\Color\Palette\ShadePalette;

include '../../vendor/autoload.php';

$baseColor = isset($_GET['color']) ? $_GET['color'] : 'electricgreen';

?>

<h1>Base Color</h1>
<?=\Phim\color_get_html($baseColor)?>

<h1>Complementary</h1>
<?=Palette::getHtml(new \Phim\Color\Scheme\ComplementaryScheme($baseColor))?>

<h1>Analogous</h1>
<?=Palette::getHtml(new \Phim\Color\Scheme\AnalogousScheme($baseColor))?>

<h1>Split-Complementary</h1>
<?=Palette::getHtml(new \Phim\Color\Scheme\SplitComplementaryScheme($baseColor))?>

<h1>Triadic</h1>
<?=Palette::getHtml(new \Phim\Color\Scheme\TriadicScheme($baseColor))?>

<h1>Tetradic</h1>
<?=Palette::getHtml(new \Phim\Color\Scheme\TetradicScheme($baseColor))?>

<h1>Square</h1>
<?=Palette::getHtml(new \Phim\Color\Scheme\SquareScheme($baseColor))?>


<h1>Tints (lightening)</h1>
<?=Palette::getHtml(new \Phim\Color\Scheme\TintScheme($baseColor, 5, .1))?>

<h1>Shades (darkening)</h1>
<?=Palette::getHtml(new \Phim\Color\Scheme\ShadeScheme($baseColor, 5, .1))?>

<h1>Tones (desaturation)</h1>
<?=Palette::getHtml(new \Phim\Color\Scheme\ToneScheme($baseColor, 5, .2))?>
