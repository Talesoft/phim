<?php

namespace Phim\Test;

use Phim\Color;
use PHPUnit\Framework\TestCase;

class ColorTest extends TestCase
{

    public function testFunctionStringConversion()
    {

        $c = Color::get('hsl(50%, 50%, 100%)')->toHsl();
        self::assertEquals(180, $c->getHue());

        $c = Color::get('hsl(-180, 50%, 100%)')->toHsl();
        self::assertEquals(180, $c->getHue());

        $c = Color::get('hsl(-150%, 50%, 100%)')->toHsl();
        self::assertEquals(180, $c->getHue());

        $c = Color::get('hsl(150%, 50%, 100%)')->toHsl();
        self::assertEquals(180, $c->getHue());
        self::assertEquals(.5, $c->getSaturation());
        self::assertEquals(1.0, $c->getLightness());

        $c = Color::get('rgb(34.23%, 20%, 120)')->toRgb();
        self::assertEquals(87, $c->getRed());
        self::assertEquals(51, $c->getGreen());
        self::assertEquals(120, $c->getBlue());

        $c = Color::get('hsla(0.872664626rad, .4, 90%, 22.3%)')->toHsla();
        self::assertEquals(50, $c->getHue());
        self::assertEquals(.4, $c->getSaturation());
        self::assertEquals(.9, $c->getLightness());
        self::assertEquals(.223, $c->getAlpha());
    }
}
