<?php

use Phim\Color\Palette;
use Phim\Color\Palette\ShadePalette;
use Phim\Color\Palette\SimplePalette;
use Phim\Color\Scheme\AnalogousScheme;
use Phim\Color\Scheme\TetradicScheme;

include '../../vendor/autoload.php';


$hueRange = isset($_GET['hue']) ? $_GET['hue'] : 'red';

$colorNames = array_values(\Phim\color_get_names());

?>
<p>
    Let's take all named colors, build tetradic complements for them and filter out the coolest values
    of a specific hue range
</p>
<?php

$palette = new SimplePalette();
foreach ($colorNames as $color) {

    $palette = $palette->add(new TetradicScheme($color));
    $palette = $palette->add(new AnalogousScheme($color));
}

$filtered = Palette::filterByHueRange($palette, $hueRange);
$deduplicated = Palette::filterDuplicates($filtered, 10);

?>
<table width="100%">
    <tr>
        <th>All</th>
        <th>Only <strong><?=$hueRange?></strong> colors</th>
        <th>Without duplicates (Tolerance: 10)</th>
    </tr>
    <tr>
        <td valign="top" align="center"><?=Palette::getHtml($palette, 4)?></td>
        <td valign="top" align="center"><?=Palette::getHtml($filtered, 4)?></td>
        <td valign="top" align="center"><?=Palette::getHtml($deduplicated, 4)?></td>
    </tr>
</table>

