
# Phim
#### Colorize your world.
---
Phim is a very functional color manipulation library.

It's designed to become a full-fledged image-manipulation library, but right now it's a color manipulation library only. Maybe one of the mightiest out there.

**Phim** is short for **PHP Image Manipulation**. Very nifty, I know, thanks.

The library is pretty experimental right now, so I don't suggest production usage, but it can do a lot of awesome stuff already.

# Installation

```bash
$ composer require talesoft/phim
```

# API

Ignore everything that doesn't start with `Color` in Phim right now.

## Color parsing

Phim can handle many different color formats

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
Color::get(0x00ff00ff); //RgbColor(0, 255, 0, 1.0)


//By function literals
Color::get('rgb(14, 24, 100)'); //RgbColor(14, 24, 100)
Color::get('hsl(120, .5, 1.0)'); //HslColor(120, 0.5, 1.0)
Color::get('lab(50, 40, 22)'); //LabColor(50, 40, 22)


//Percent-values are allowed and will scale automatically
Color::get('rgba(50%, 100, 20%, 50%)'); //RgbaColor(127.5, 100, 51, 0.5)
Color::get('hsl(50%, 50%, 1.0)'); //HslColor(180, 0.5, 1.0)


//You can also just create them by hand

use Phim\Color\RgbColor;
use Phim\Color\HslaColor;

$rgb = new RgbColor(0, 100, 0);
$hsla = new HslaColor(120, .5, .1, 1.0);
```

## Color conversion

Every color can be converted to every other color space instantly.

```php
$color->getHsl()->getLightness();

$color->getRgb()->getGreen();

$color->getLab()->getL();
```


Here's a list of the supported color spaces with their respective value methods

- RGB (`getRgb(): RgbColor`)
    - `getRed()`
    - `getGreen()`
    - `getBlue()`
    - `withAlphaSupport(): RgbaColor`
- RGBA (`getRgba()`)
    - `getRed()`
    - `getGreen()`
    - `getBlue()`
    - `getAlpha()`
    - `withoutAlphaSupport(): RgbColor`
- HSL (`getHsl()`)
    - `getHue()`
    - `getSaturation()`
    - `getLightness()`
    - `withAlphaSupport(): HslaColor`
- HSLA (`getHsla()`)
    - `getHue()`
    - `getSaturation()`
    - `getLightness()`
    - `getAlpha()`
    - `withoutAlphaSupport(): HslColor`
- HSV (`getHsv()`)
    - `getHue()`
    - `getSaturation()`
    - `getValue()`
    - `withAlphaSupport(): HsvaColor`
- HSVA (`getHsva()`)
    - `getHue()`
    - `getSaturation()`
    - `getValue()`
    - `getAlpha()`
    - `withoutAlphaSupport(): HsvColor`
- CIE XYZ (`getXyz()`)
    - `getX()`
    - `getY()`
    - `getZ()`
    - `withAlphaSupport(): RgbaColor`
- CIE L\*a\*b\* (`getLab()`)
    - `getL()`
    - `getA()`
    - `getB()`
    - `withAlphaSupport(): RgbaColor`

The system is designed so that you _don't need to know_ in which color space you're getting your current color in. If you want to do modifications on a color, just convert it to the color space you need prior to that.

```php
echo Color::get('red')->getHsl()->withLightness(.5); //Setting the lightness of the color to 50%
```


## Immutability

Colors are immutable. Setters are not prefixed with `set`, but with `with`.

```php
use Phim\Color\RgbColor;

$rgb = (new RgbColor())
    ->withRed(255)
    ->withGreen(100)
    ->withBlue(50);
```

Every modification will create a new color instance, the old instance will be kept intact. A color instance never changes its own values, you can rely on that completely.


## Color modification

Color modification is done by converting to specific color spaces and modifying their values. e.g. the HSL color space is very handy for reducing lightness or increasing saturation of a color.

The `Phim\Color`-class will shorten most operations for you. You don't need to convert the color to any space when using the `Color`-class static methods, it automatically converts them to the space it needs for the operation.

Notice that these will almost always change the return type of your color. Convert back and forth to the format you require in your application, double-conversions have a really low memory profile.

```php
use Phim\Color;


//Lightening and darkening (Added, not multiplied)
Color::lighten($color, .4);
Color::darken($color, .2);

//Get the complementary color
$complement = Color::complement($color);

//Convert to grayscale
Color::grayscale($color);

//Fade in or out
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

## Color operations

Sometimes you want to do more with your color.

```php
//Get the hue range the color resides in (basically, "what base color is this color"?)
//Supported hue ranges are red, yellow, green, cyan, blue and magenta.
Color::getColorHueRange(Color::get('rgba(80, 0, 0)')); //Color::HUE_RANGE_RED

//Gets the hexadecimal representation of a color.
//Notice that it allows Alpha colors, because it can also read them.
//If you want to use the hex value in CSS or HTML, convert it to RGB before
Color::getHexString($color);

//Gets the integer representation of a color (supporting up to 4 channels)
Color::getInt($color);

//Get the name of a color. Many colors don't have names, it will
//return a hex-string representation in this case
Color::getName($color);
```

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

foreach ($colors as $color) {

    //Using a tolerance of 2, so the maximum difference between the
    //colors is 2
    if (Color::equals($red, $color, 2))
        echo "Well, this is almost the same color!";
}
```


If that's not already enough, lets go on! I got more cool stuff.

## Color palettes

Basically a small helper class to keep colors together, acts like a normal array.
Passed colors get converted automatically.

The maximum size can be limited with the second parameter to `SimplePalette`.

```php
use Phim\Color\Palette\SimplePalette;

$palette = new SimplePalette([
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


You can manipulate palettes with the `Palette`-class

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
//in the palette in order to be taken in.
$palette = Palette::filterSimilarColors($palette, 4);
```

## Schemes

Schemes are pre-defined, generated palettes. They take a base color and generate a bunch of related colors out of them. For more information, you may read [this](http://www.tigercolor.com/color-lab/color-theory/color-theory-intro.htm).
This is also where I ripped the following images from.

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

### Hue Rotation Scheme

Adds adjacent colors in the hue circle.

The code below would generate 5 colors, the base color and 4 further colors each rotated by +5° in hue.

```php
use Phim\Color\Scheme\HueRotationScheme;

$colors = new HueRotationScheme($baseColor, 5, 5); //5 colors, +5° hue per color
```

### Tint Scheme

Generates lighter tints of the color.

```php
use Phim\Color\Scheme\TintScheme;

$colors = new TintScheme($baseColor, 6, .3); //6 colors, +.3 lightness per color
```

### Shade Scheme

Generates darker shades of the color.

```php
use Phim\Color\Scheme\ShadeScheme;

$colors = new ShadeScheme($baseColor, 6, .3); //6 colors, -.3 lightness per color
```

### Tone Scheme

Generates less saturated tones of the color.

```php
use Phim\Color\Scheme\ToneScheme;

$colors = new ToneScheme($baseColor, 6, .3); //6 colors, -.3 saturation per color
```


## Putting it all together

Notice that you can combine and filter the result of a scheme, since they are also palettes. The result will always be a `SimplePalette` instance (Even in the `NameMonochromaticScheme`, so beware, you'll use your naming functionality completely)

You can combine all that stuff above into some awesome color operations.

```php
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

//Print a nice HTML representation with 4 columns of the palette for debugging
Palette::getHtml($palette, 4);
```

This will yield the colors `blue` and `navy`. Reducing the required range
on `filterSimilarColors` will yield more and different blue colors.

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

Notice that functions always convert to their respective class automatically, so doing things like

```php
<div style="width: 100%; background: <?=Color::get('red')->withAlphaSupport()->withAlpha($alpha)?>;"></div>
```

is absolutely valid, since you can assume the result will be an `RgbaColor` instance.

It can get even shorter by using

```php
<div style="width: 100%; background: <?=Color::fade(Color::get('red'), $alpha)?>;"></div>
```

Named colors will always return a `RgbColor` instance. Using `withAlphaSupport()` will always return the respective alpha-version of a color.

Also notice that Xyz and Lab don't have Alpha-versions and will just return an `RgbaColor`-instance of the same color.


# Examples, Code, Contribution, Support

If you have questions, problems with the code or you want to contribue, either consult the [examples](https://github.com/Talesoft/phim/tree/ma                              ster/tests/pragmatic), the [code](https://github.com/Talesoft/phim/tree/master/src/Phim), write an [issue](https://github.com/Talesoft/phim/issues) or [send me an E-Mail](mailto:torben@talesoft.codes).
You can also contribute via pull requests, just send them in.

For a list of all available color names [click here](https://github.com/Talesoft/phim/blob/master/data/colors). 

If you like my work, it helped you in some way, eased up work for you or anything like that, think about supporting me by [spending me a coffee](https://www.paypal.me/TorbenKoehn).

# Credits

- http://wikipedia.com
- http://www.easyrgb.com                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
- http://www.tigercolor.com/color-lab/color-theory/color-theory-intro.htm
- https://gist.github.com/mjackson/5311256
- https://raw.githubusercontent.com/RnbwNoise/ImageAffineMatrix/master/ImageAffineMatrix.php
- https://github.com/Qix-/color-convert/blob/master/conversions.js