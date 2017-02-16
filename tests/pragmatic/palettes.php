<?php

use Phim\Color;
use Phim\Color\Palette;
use Phim\Color\Palette\ShadePalette;
use Phim\Color\Palette\SimplePalette;
use Phim\Color\Scheme\AnalogousScheme;
use Phim\Color\Scheme\TetradicScheme;
use function Phim\color_get;

include '../../vendor/autoload.php';

$colors = [Color::RED, Color::BLUE, Color::GREEN, Color::YELLOW];

$palette = new SimplePalette();

foreach ($colors as $color) {

    //Add the tetradic scheme for each color
    $palette = Palette::merge($palette, new TetradicScheme($color));
}

//Only take blue-ish colors
$palette = Palette::filterByHueRange($palette, Color::HUE_RANGE_BLUE);

//Avoid similar colors
$palette = Palette::filterSimilarColors($palette, 8);

//Print a nice HTML representation of the palette for debugging
echo Palette::toHtml($palette, 4);
exit;


$hueRange = isset($_GET['hue']) ? $_GET['hue'] : 'red';

$colorNames = array_values(\Phim\color_get_names());
?>
<h1>Color palette manipulation and color finding</h1>
<p>
    Let's take all named colors, build tetradic complements for them and filter out the coolest values
    of a specific hue range.
    <br>
    <br>
    <a href="?hue=red">Red</a> | <a href="?hue=yellow">Yellow</a> | <a href="?hue=blue">Blue</a>
    | <a href="?hue=cyan">Cyan</a> | <a href="?hue=green">Green</a> | <a href="?hue=magenta">Magenta</a>
</p>
<?php

$palette = new SimplePalette();
foreach ($colorNames as $color) {

    $palette = $palette->add(new TetradicScheme($color));
}

$filtered = Palette::filterByHueRange($palette, $hueRange);
$deduplicated = Palette::filterSimilarColors($filtered, 15);

?>
<table width="100%">
    <tr>
        <th>All</th>
        <th>Only <strong><?=$hueRange?></strong> colors</th>
        <th>Without duplicates (Tolerance: 15, meaning that they have a color difference of at least 15)</th>
    </tr>
    <tr>
        <td valign="top" align="center"><?=Palette::toHtml($palette, 4)?></td>
        <td valign="top" align="center"><?=Palette::toHtml($filtered, 4)?></td>
        <td valign="top" align="center"><?=Palette::toHtml($deduplicated, 4)?></td>
    </tr>
</table>

