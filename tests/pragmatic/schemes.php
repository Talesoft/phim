<?php

use Phim\Color\Palette;
use Phim\Color\Palette\ShadePalette;
use Phim\Color\Scheme\AnalogousScheme;
use Phim\Color\Scheme\ComplementaryScheme;
use Phim\Color\Scheme\MonochromaticScheme;
use Phim\Color\Scheme\ShadeScheme;
use Phim\Color\Scheme\SplitComplementaryScheme;
use Phim\Color\Scheme\SquareScheme;
use Phim\Color\Scheme\TetradicScheme;
use Phim\Color\Scheme\TintScheme;
use Phim\Color\Scheme\ToneScheme;
use Phim\Color\Scheme\TriadicScheme;
use function Phim\color_get_html;

include '../../vendor/autoload.php';

$baseColor = isset($_GET['color']) ? $_GET['color'] : 'electricgreen';

?>

<h1>Base Color</h1>
<?=\Phim\color_get_html($baseColor)?>

<h1>Complementary</h1>
<?=Palette::getHtml(new ComplementaryScheme($baseColor))?>

<h1>Analogous</h1>
<?=Palette::getHtml(new AnalogousScheme($baseColor))?>

<h1>Split-Complementary</h1>
<?=Palette::getHtml(new SplitComplementaryScheme($baseColor))?>

<h1>Triadic</h1>
<?=Palette::getHtml(new TriadicScheme($baseColor))?>

<h1>Tetradic</h1>
<?=Palette::getHtml(new TetradicScheme($baseColor))?>

<h1>Square</h1>
<?=Palette::getHtml(new SquareScheme($baseColor))?>


<h1>Tints (base->light)</h1>
<?=Palette::getHtml(new TintScheme($baseColor, 4, .1))?>

<h1>Shades (base->dark)</h1>
<?=Palette::getHtml(new ShadeScheme($baseColor, 4, .1))?>

<h1>Monochromatic (dark->base->light)</h1>
<?=Palette::getHtml(new MonochromaticScheme($baseColor, 4, .1))?>

<h1>Tones (base->desaturated)</h1>
<?=Palette::getHtml(new ToneScheme($baseColor, 4, .2))?>




<h1>Named Monochromatic Scheme</h1>
<?php $ns = new \Phim\Color\Scheme\NamedMonochromaticScheme($baseColor, .1); ?>
<p>
    Darkest Shade:<br><?=color_get_html($ns->getDarkestShade())?><br>
    Darker Shade:<br><?=color_get_html($ns->getDarkerShade())?><br>
    Dark Shade:<br><?=color_get_html($ns->getDarkShade())?><br>
    Normal:<br><?=color_get_html($ns->getBaseColor())?><br>
    Light Tint:<br><?=color_get_html($ns->getLightTint())?><br>
    Lighter Tint:<br><?=color_get_html($ns->getLighterTint())?><br>
    Lightest Tint:<br><?=color_get_html($ns->getLightestTint())?><br>
</p>

