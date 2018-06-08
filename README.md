
# Phim
#### PHP Image Manipulation

---

## What is Phim?

Phim is an image manipulation library for PHP. It includes a powerful color manipulation library
and image processing abstraction for several adapters, including GD and Imagick.

This library is still in development. If you're interested in helping out, write an e-mail to <torben@talesoft.codes>. 

---

## Installation

Install via Composer.

```bash
$ composer require talesoft/phim
```

---

## What is finished, what needs to be done?

- [x] Color Manipulation
    - [x] RGB
    - [x] RGBA
    - [x] HSL
    - [x] HSLA
    - [x] HSV
    - [x] HSVA
    - [x] CIE XYZ
    - [x] CIE L\*a\*b\*
    - [x] CIEDE2000 Color Comparison
- [ ] Geometry
    - [x] Basic Geometrical Shapes
    - [ ] Geometrical Math utilities per Shape
- [ ] Image Manipulation
    - [ ] Abstract Image Representation
        - [x] Lines/Straight Paths
        - [x] Polygons/Shapes
        - [ ] Curves/Circles/Ellipses/Arcs
    - [ ] Creating Images
        - [x] Image and Shape Factory
        - [ ] Transformations
        - [ ] Color-Filters (Act on `ColorInterface`)
        - [ ] Point-Filters (Act on `PointInterface`)
    - [ ] Rendering Adapters
        - [ ] GD
            - [x] Basic rendering
            - [ ] Fully compatible rendering
        - [ ] Imagick
            - [ ] Basic rendering
            - [ ] Fully compatible rendering
        - [ ] Phim (library-intern, own rendering)
            - [ ] Basic rendering
            - [ ] Fully compatible rendering
    - [ ] Image File Parsing
        - [ ] Parse PNG
        - [ ] Parse JPG
        - [ ] Parse GIF
        - [ ] Parse BMP
        - [ ] Parse WebP
        - [ ] Parse animated GIF
        - [ ] Parse ICO
        - [ ] Parse SVG
        - [ ] Parse PDF
        - [ ] Parse PSD
        - [ ] Parse AI (Possible?)
        - [ ] Parse EPS
        - [ ] Parse GhostScript
        
---

## Can I use this in production?

You can use the color manipulation in production already, it's tested and stable.
Everything else is very experimental and shouldn't be used in production anywhere right now.

---

# API

## Color parsing

Phim can handle many different color formats and modify them on a very detailed level.

Any color Phim provides will be of type `Phim\ColorInterface`. They usually
have a higher-level class which defines what color space the color is in.

Phim is designed so that you don't need to care about what color space your color is in. If you need a different
one to modify the color, just use one of the `to{Space}`-functions.

It all starts with the `Color::get()` function, which will take a mixed argument and provide
a valid color of type `ColorInterface` for you.

You can pass color names, integer values, hex-strings and function-literals freely.

```php
use Phim\Color;

//By name
Color::get('red'); //RgbColor(255,0,0)
Color::get(Color::MAROON); //RgbColor(128, 0, 0)


//By hex string
Color::get('#00ff00'); //RgbColor(0, 255, 0)
Color::get('#00f'); //RgbColor(0, 0, 255)
Color::get('#000a'); //RgbaColor(0, 0, 0, 0.1)


//By integer
Color::get(0x00ff00); //RgbColor(0, 255, 0)
Color::get(0x00ff00ff); //RgbaColor(0, 255, 0, 1.0)


//By function literals
Color::get('rgb(14, 24, 100)'); //RgbColor(14, 24, 100)
Color::get('hsl(120, .5, 1.0)'); //HslColor(120, 0.5, 1.0)
Color::get('lab(50, 40, 22)'); //LabColor(50, 40, 22)


//Percent-values are allowed and will scale automatically
Color::get('rgba(50%, 100, 20%, 50%)'); //RgbaColor(127.5, 100, 51, 0.5)
Color::get('hsl(50%, 50%, 1.0)'); //HslColor(180, 0.5, 1.0)


//You can also just create them manually (better performance)

use Phim\Color\RgbColor;
use Phim\Color\HslaColor;

$myRgbColor = new RgbColor(0, 100, 0);
$myHslaColor = new HslaColor(120, .5, .1, 1.0);
```

---

## Color conversion

Every color in Phim can be converted to any other color space instantly.

```php
$color->toHsl()->getLightness();

$color->toRgb()->getGreen();

$color->toLab()->getL();
```


Here's a list of the supported color spaces with their respective getters/setters for their values

- RgbColor (`toRgb()`)
    - `getRed() | setRed($red)`
    - `getGreen() | setGreen($green)`
    - `getBlue() | setBlue($blue)`
    - `toAlpha() -> RgbaColor`
- RgbaColor (`toRgba()`)
    - `getRed() | setRed($red)`
    - `getGreen() | setGreen($green)`
    - `getBlue() | setBlue($blue)`
    - `getAlpha() | setAlpha($alpha)`
    - `toOpaque() -> RgbColor`
- HslColor (`toHsl()`)
    - `getHue() | setHue($hue)`
    - `getSaturation() | setSaturation($saturation)`
    - `getLightness() | setLightness($lightness)`
    - `toAlpha() -> HslaColor`
- HslaColor (`getHsla()`)
    - `getHue() | setHue($hue)`
    - `getSaturation() | setSaturation($saturation)`
    - `getLightness() | setLightness($lightness)`
    - `getAlpha() | setAlpha($alpha)`
    - `toOpaque() -> HslColor`
- HsvColor (`toHsv()`)
    - `getHue() | setHue($hue)`
    - `getSaturation() | setSaturation($saturation)`
    - `getValue() | setValue($value)`
    - `toAlpha() -> HsvaColor`
- HsvaColor (`toHsva()`)
    - `getHue() | setHue($hue)`
    - `getSaturation() | setSaturation($saturation)`
    - `getLightness() | setLightness($lightness)`
    - `getAlpha() | setAlpha($alpha)`
    - `toOpaque() -> HsvColor`
- XyzColor (`toXyz()`)
    - `getX() | setX($x)`
    - `getY() | setY($y)`
    - `getZ() | setZ($z)`
    - `toAlpha() -> RgbaColor`
- CIE L\*a\*b\* (`toLab()`)
    - `getL() | setL($l)`
    - `getA() | setA($a)`
    - `getB() | setB($b)`
    - `toAlpha() -> RgbaColor`

With this system, you can easily manipulate colors through a really expressive API. Let's have a quick look.

```php

$lightTurquoise = Color::get('blue')
    ->toRgb()
        ->setGreen(50) //Mix some green in
    ->toHsl()
        ->setLightness(.6) //Make it lighter
    ->toAlpha()
        ->setAlpha(.4) //Add 40% transparency
    ->toRgba(); //Make sure it's an RGBA color in the end
    
echo $lightTurquoise; //Will print `rgba(50,90,255,0.4)`
```

We will now look at the possibilities in detail.

---

## Color modification

Color modification is done by converting to specific color spaces and modifying their values. e.g. the HSL color space is very handy for reducing lightness or increasing saturation of a color.

The `Phim\Color`-class will shorten most operations for you. You don't need to convert the color to any space when using the `Color`-class static methods, it automatically converts them to the space it needs for the operation.

Notice that these will almost always change the return type of your color. Convert back and forth to the format you require in your application, double-conversions have a really low memory profile.

```php
use Phim\Color;

//Lightening and darkening (Added, not multiplied)
Color::lighten($color, .4);
Color::darken($color, .2);

//Get the complementary color (180° rotated hue)
Color::complement($color);

//Convert to grayscale
Color::grayscale($color);

//Fade in or out (Added, not multiplied)
Color::fade($color, .1);
Color::fade($color, -.1);

//Mix two colors
Color::mix($color, $mixColor);

//Inverse a color
Color::inverse($color);

//Saturate/Desaturate
Color::saturate($color, .4);
Color::desaturate($color, .2);
```

---

## Color information

The `Color` static class also contains useful utilities that help receiving information of the color you pass to them.

```php
//Get the hue range the color resides in (basically, "what base color is this color"?)
//Supported hue ranges are: RED, YELLOW, GREEN, CYAN, BLUE and MAGENTA.
Color::getColorHueRange(Color::get('rgba(80, 0, 0)')); //Color::HUE_RANGE_RED

//Gets the hexadecimal representation of a color.
//Notice that it will turn an Alpha-color into a 4-channel hexadecimal string, because it can also parse them.
//If you want to use the hex value in CSS or HTML, use `toRgb()` on the color before to strip the alpha channel
Color::toHexString($color);

//Gets the integer representation of a color (including support for alpha channel)
Color::toInt($color);

//Get the name of a color. Many colors don't have names, it will return a hex-representation in this case
Color::toName($color);
```

---

## Color comparison

Through the implementation of CIE XYZ, CIE L\*a\*b\* and the CIEDE2000 standard for color comparison, you can compare colors visually easily

```php
$red = Color::get('red'); //rgb(255, 0, 0)

Color::getDifference($red, Color::get('blue')); //52.878674140461

Color::getDifference($red, Color::get('maroon')); //25.857031489394

Color::getDifference($red, Color::get('rgb(250, 0, 0)')); //1.0466353226581
```

To compare colors with a tolerance, you can use the `equals`-method

```php
$red = Color::get('red');

foreach ($otherColors as $otherColor) {

    //Using a tolerance of 2, so the maximum difference between the colors is 2
    if (Color::equals($red, $otherColor, 2))
        echo "Well, this is almost the same color!";
}
```


If that's not already enough, lets go on! Phim got more cool stuff.

---

## Color palettes

Basically a small helper class to keep colors together, acts like a normal array.
Passed colors get converted automatically.

The maximum size can be limited with the second parameter to `Palette`.

```php
use Phim\Color\Palette;

$palette = new Palette([
    'red',
    'green',
    'blue',
    'yellow',
    'white',
    'black'
]);

$palette[] = 'rgb(120, 35, 56)';

$palette[0]; //RgbColor(255, 0, 0)
$palette[6]; //RgbColor(120, 35, 56)
```

You can manipulate palettes with the static methods of the `Palette`-class

### Merging palettes

```php
use Phim\Color\Palette;

$palette = Palette::merge($somePalette, $someOtherPalette);
```

### Filtering palettes

```php
use Phim\Color\Palette;
use Phim\ColorInterface;

//Filter all colors that have a lightness below .4
$palette = Palette::filter(function(ColorInterface $color) {
    
    return $color->getHsl()->getLightness() >= .4;
});
```

### Pre-defined filters

Filter all colors based on a hue range. You'll only get colors in the given hue range.

```php
use Phim\Color\Palette;

//Would only yield colors that have a red-ish hue
$palette = Palette::filterByHueRange($palette, Color::HUE_RANGE_RED);
```

Filter out colors that _look_ similar (Uses CIEDE2000 for color comparison)
```php
use Phim\Color\Palette;

//Colors would need to have a difference of at least 4 to all other colors
//in the palette in order to be put in the result collection.
$palette = Palette::filterSimilarColors($palette, 4);
```

---

## Color Schemes

Schemes are pre-defined, generated palettes. They take a base color and generate a bunch of related colors out of them. For more information, you may read [this](http://www.tigercolor.com/color-lab/color-theory/color-theory-intro.htm).
This is also where I ripped the following images from.

Notice that any scheme is always a palette like above, too.

Phim can generate the following schemes for you:

### Schemes with fixed size

#### Complementary Scheme

![Complementary Scheme](http://www.tigercolor.com/Images/Complementary.gif)
```php
use Phim\Color\Scheme\ComplementaryScheme;

$colors = new ComplementaryScheme($baseColor); //2 colors
```

#### Analogous Scheme

![Analogous Scheme](http://www.tigercolor.com/Images/Analogous.gif)
```php
use Phim\Color\Scheme\AnalogousScheme;

$colors = new AnalogousScheme($baseColor); //3 colors
```

#### Triadic Scheme

![Triadic Scheme](http://www.tigercolor.com/Images/Triad.gif)
```php
use Phim\Color\Scheme\TriadicScheme;

$colors = new TriadicScheme($baseColor); //3 colors
```

#### Split-Complementary Scheme

![Split-Complementary Scheme](http://www.tigercolor.com/Images/SplitComplementary.gif)
```php
use Phim\Color\Scheme\SplitComplementaryScheme;

$colors = new SplitComplementaryScheme($baseColor); //3 colors
```

#### Tetradic Scheme

![Tetradic Scheme](http://www.tigercolor.com/Images/Tetrad.gif)
```php
use Phim\Color\Scheme\TetradicScheme;

$colors = new TetradicScheme($baseColor); //4 colors
```

#### Square Scheme

![Square Scheme](http://www.tigercolor.com/Images/Square.gif)
```php
use Phim\Color\Scheme\SquareScheme;

$colors = new SquareScheme($baseColor); //4 colors
```

#### Named Monochromatic Scheme

Generates 3 shades and 3 tints of a color that you can access via a method. The second parameter is `step` which defines the amount of darkening/lightening between each color.

```php
use Phim\Color\Scheme\NamedMonochromaticScheme;

$colors = new NamedMonochromaticScheme($baseColor, .3); //7 colors

$colors->getDarkestShade();
$colors->getDarkerShader();
$colors->getDarkShade();
$colors->getBaseColor();
$colors->getLightTint();
$colors->getLighterTint();
$colors->getLightestTint();
```


### Generated schemes (dynamic size)

These take an `amount` and `step`. `amount` specifies the total amount of colors to generate. Specifying `5` will yield a palette with 5 colors (Including the base-color, mostly)

#### Hue Rotation Scheme

Adds adjacent colors in the hue circle.

The code below would generate 5 colors, the base color and 4 further colors each rotated by +5° in hue.

```php
use Phim\Color\Scheme\HueRotationScheme;

$colors = new HueRotationScheme($baseColor, 5, 5); //5 colors, +5° hue per color
```

#### Tint Scheme

Generates lighter tints of the color.

```php
use Phim\Color\Scheme\TintScheme;

$colors = new TintScheme($baseColor, 6, .3); //6 colors, +.3 lightness per color
```

#### Shade Scheme

Generates darker shades of the color.

```php
use Phim\Color\Scheme\ShadeScheme;

$colors = new ShadeScheme($baseColor, 6, .3); //6 colors, -.3 lightness per color
```

#### Tone Scheme

Generates less saturated tones of the color.

```php
use Phim\Color\Scheme\ToneScheme;

$colors = new ToneScheme($baseColor, 6, .3); //6 colors, -.3 saturation per color
```

If you are not sure what a scheme will end up, you can always dump a visual representation of the whole palette by using

```php
Palette::toHtml($myPalette);
```

This will print a little table containing all colors in the palette including basic information about the colors.

To roll your own scheme, you have many possibilities, the most simple one is extending `Phim\Color\SchemeBase` or `Phim\Color\Scheme\ContinousSchemeBase`

```php
<?php

namespace Phim\Color\Scheme;

use Phim\Color;
use Phim\ColorInterface;

class MyCustomScheme extends Color\SchemeBase
{

    protected function generate(ColorInterface $baseColor)
    {

    	//Generates the passed base-color with 5 different lightness values
    	yield $baseColor->toHsl()->setLightness(.1);
    	yield $baseColor->toHsl()->setLightness(.2);
    	yield $baseColor->toHsl()->setLightness(.3);
    	yield $baseColor->toHsl()->setLightness(.4);
    	yield $baseColor->toHsl()->setLightness(.5);
    }
}
```

```php
<?php

namespace Phim\Color\Scheme;

use Phim\Color;
use Phim\ColorInterface;

class MyCustomContinousScheme extends Color\Scheme\ContinousSchemeBase
{

    protected function generateStep(ColorInterface $baseColor, $i, $step)
    {

    	//Does the same as above, but both, the amount and step-value can be passed to the constructor
        return Color::lighten($baseColor, $i * $step);
    }
}
```

---


## Putting it all together

Notice that you can combine and filter the result of a scheme, since they are also palettes. The result will always be a `Palette` instance (Even in the `NameMonochromaticScheme`, so beware, you'll use your naming functionality completely)

You can combine all that stuff above into some awesome color operations.

```php
$colors = [Color::RED, Color::BLUE, Color::GREEN, Color::YELLOW];

$palette = new Palette();

foreach ($colors as $color) {

    //Add the tetradic scheme for each color
    $palette = Palette::merge($palette, new TetradicScheme($color));
}

//Only take blue-ish colors
$palette = Palette::filterByHueRange($palette, Color::HUE_RANGE_BLUE);

//Avoid similar colors
$palette = Palette::filterSimilarColors($palette, 8);

//Print a nice HTML representation with 4 columns of the palette for debugging
Palette::toHtml($palette, 4);
```

This will yield the colors `blue` and `navy`. Reducing the required range on `filterSimilarColors` will yield more and different blue-ish colors.

---

## Using a color in HTML

The colors mostly convert to their best CSS representation automatically when casted to a string.

```php
echo Color::get('red'); //'rgb(255, 0, 0)'
echo Color::get('hsl(120, .5, .2)'); //'hsl(120, 50%, 20%)'
```

Given that some browsers don't support `hsl()` CSS colors, it's best to always convert to RGB or RGBA before casting to a string.

```php
echo Color::get('red')->getRgba(); //rgba(255, 0, 0, 1)
```

It's not automatically done to give you the ability to also use the `hsl()` writing style. We also don't know, if CSS will implement further color constructors in the future.

Notice that most literals you pass to `Color::get` return an `RgbaColor`-instance, as most systems (hex, int, names) are designed based on RGB values.

---

## Geometry, Image manipulation etc.

As you can see, this README will get pretty big if I keep it up now, so I'll stop here and slowly work on better structured documentation.

You can see a quick example of how image manipulation will work in [tests/how-to.php](https://github.com/Talesoft/phim/tree/master/tests/how-to.php)

---

## Examples, Code, Contribution, Support

If you have questions, problems with the code or you want to contribue, either consult the [examples](https://github.com/Talesoft/phim/tree/master/tests/pragmatic), the [code](https://github.com/Talesoft/phim/tree/master/src/Phim), write an [issue](https://github.com/Talesoft/phim/issues) or [send me an E-Mail](mailto:torben@talesoft.codes).
You can also contribute via pull requests, just send them in.

For a list of all available color names [click here](https://github.com/Talesoft/phim/blob/master/data/colors). 

If you like my work, it helped you in some way, eased up work for you or anything like that, think about supporting me by [spending me a coffee](https://www.paypal.me/TorbenKoehn).

## Credits

- http://wikipedia.com
- http://www.easyrgb.com                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
- http://www.tigercolor.com/color-lab/color-theory/color-theory-intro.htm
- https://gist.github.com/mjackson/5311256
- https://raw.githubusercontent.com/RnbwNoise/ImageAffineMatrix/master/ImageAffineMatrix.php
- https://github.com/Qix-/color-convert/blob/master/conversions.js
