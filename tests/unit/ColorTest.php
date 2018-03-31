<?php

namespace Phim\Test;

use Phim\Color;
use Phim\Color\RgbaColor;
use Phim\Color\RgbColor;
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

        $c = Color::get('#6BBAA7')->toRgb();
        self::assertEquals(107, $c->getRed());
        self::assertEquals(186, $c->getGreen());
        self::assertEquals(167, $c->getBlue());

        $c = Color::get('hsla(0.872664626rad, .4, 90%, 22.3%)')->toHsla();
        self::assertEquals(50, $c->getHue());
        self::assertEquals(.4, $c->getSaturation());
        self::assertEquals(.9, $c->getLightness());
        self::assertEquals(.223, $c->getAlpha());

        setlocale(LC_NUMERIC, 'sk_SK');

        $c = Color::get('rgb(10, 56, 100)')->toRgba()->setAlpha(.5);
        self::assertEquals('rgba(10,56,100,0.50)', (string) $c);
    }

    public function testIntegerConversion()
    {

        for ($r = 0; $r < 255; $r += 50) {
            for ($g = 0; $g < 255; $g += 50) {
                for ($b = 0; $b < 255; $b += 50) {
                    for ($a = 0; $a < 1.0; $a += .1) {

                        $c = new Color\RgbaColor($r, $g, $b, $a);
                        $c = Color::parseInt(Color::toInt($c));
                        self::assertEquals($r, $c->getRed());
                        self::assertEquals($g, $c->getGreen());
                        self::assertEquals($b, $c->getBlue());
                        self::assertEquals($a, $c->getAlpha(), '', .01);
                    }
                }
            }
        }
    }
}
