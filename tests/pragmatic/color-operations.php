<?php

use Phim\Color;
use function Phim\get_color;

include '../../vendor/autoload.php';

echo Color::getHtml(get_color('red'));
echo Color::getHtml(Color::lighten(get_color('red'), .3));;
echo Color::getHtml(Color::darken(get_color('red'), .3));
echo Color::getHtml(get_color('black'));;
echo Color::getHtml(Color::lighten(get_color('black'), .3));;
echo Color::getHtml(Color::darken(get_color('black'), .3));
echo Color::getHtml(Color::mix(get_color('red'), get_color('black')));

echo '<br>';
echo Color::getHtml(get_color('rgba(255, 0, 0, .5)'));
echo Color::getHtml(Color::lighten(get_color('rgba(255, 0, 0, .5)'), .3));;
echo Color::getHtml(Color::darken(get_color('rgba(255, 0, 0, .5)'), .3));
echo Color::getHtml(get_color('blue'));
echo Color::getHtml(Color::lighten(get_color('blue'), .3));;
echo Color::getHtml(Color::darken(get_color('blue'), .3));
echo Color::getHtml(Color::mix(get_color('rgba(255, 0, 0, .5)'), get_color('blue')));

echo '<br>';
echo Color::getHtml(get_color('red'));
echo Color::getHtml(Color::lighten(get_color('red'), .3));;
echo Color::getHtml(Color::darken(get_color('red'), .3));
echo Color::getHtml(get_color('yellow'));
echo Color::getHtml(Color::lighten(get_color('yellow'), .3));;
echo Color::getHtml(Color::darken(get_color('yellow'), .3));
echo Color::getHtml(Color::mix(get_color('red'), get_color('yellow')));

echo '<br>';
echo Color::getHtml(get_color('red'));
echo Color::getHtml(get_color('lime'));
echo Color::getHtml(get_color('blue'));
echo Color::getHtml(get_color('yellow'));
echo Color::getHtml(get_color('magenta'));
echo Color::getHtml(get_color('cyan'));

echo '<br>';
echo Color::getHtml(get_color('red')->fade(.3));
echo Color::getHtml(Color::fade(get_color('lime'), .3));
echo Color::getHtml(Color::fade(get_color('blue'), .3));
echo Color::getHtml(Color::fade(get_color('yellow'), .3));
echo Color::getHtml(Color::fade(get_color('magenta'), .3));
echo Color::getHtml(Color::fade(get_color('cyan'), .3));

echo '<br>';
echo Color::getHtml(Color::inverse(get_color('red')));
echo Color::getHtml(Color::inverse(get_color('lime')));
echo Color::getHtml(Color::inverse(get_color('blue')));
echo Color::getHtml(Color::inverse(get_color('yellow')));
echo Color::getHtml(Color::inverse(get_color('magenta')));
echo Color::getHtml(Color::inverse(get_color('cyan')));

echo '<br>';
echo Color::getHtml(Color::saturate(get_color('red'), .3));
echo Color::getHtml(Color::saturate(get_color('lime'), .3));
echo Color::getHtml(Color::saturate(get_color('blue'), .3));
echo Color::getHtml(Color::saturate(get_color('yellow'), .3));
echo Color::getHtml(Color::saturate(get_color('magenta'), .3));
echo Color::getHtml(Color::saturate(get_color('cyan'), .3));

echo '<br>';
echo Color::getHtml(Color::desaturate(get_color('red'), .3));
echo Color::getHtml(Color::desaturate(get_color('lime'), .3));
echo Color::getHtml(Color::desaturate(get_color('blue'), .3));
echo Color::getHtml(Color::desaturate(get_color('yellow'), .3));
echo Color::getHtml(Color::desaturate(get_color('magenta'), .3));
echo Color::getHtml(Color::desaturate(get_color('cyan'), .3));

echo '<br>';
echo Color::getHtml(Color::greyscale(get_color('red')));
echo Color::getHtml(Color::greyscale(get_color('lime')));
echo Color::getHtml(Color::greyscale(get_color('blue')));
echo Color::getHtml(Color::greyscale(get_color('yellow')));
echo Color::getHtml(Color::greyscale(get_color('magenta')));
echo Color::getHtml(Color::greyscale(get_color('cyan')));

echo '<br>';
echo Color::getHtml(Color::complement(get_color('red')));
echo Color::getHtml(Color::complement(get_color('lime')));
echo Color::getHtml(Color::complement(get_color('blue')));
echo Color::getHtml(Color::complement(get_color('yellow')));
echo Color::getHtml(Color::complement(get_color('magenta')));
echo Color::getHtml(Color::complement(get_color('cyan')));

echo '<br>';
echo Color::getHtml(Color::complement(get_color('red'), 90));
echo Color::getHtml(Color::complement(get_color('lime'), 90));
echo Color::getHtml(Color::complement(get_color('blue'), 90));
echo Color::getHtml(Color::complement(get_color('yellow'), 90));
echo Color::getHtml(Color::complement(get_color('magenta'), 90));
echo Color::getHtml(Color::complement(get_color('cyan'), 90));

echo '<br>';
echo Color::getHtml(Color::complement(get_color('red'), -90));
echo Color::getHtml(Color::complement(get_color('lime'), -90));
echo Color::getHtml(Color::complement(get_color('blue'), -90));
echo Color::getHtml(Color::complement(get_color('yellow'), -90));
echo Color::getHtml(Color::complement(get_color('magenta'), -90));
echo Color::getHtml(Color::complement(get_color('cyan'), -90));