<?php

namespace Phim\Test;

use Phim\Color;

class ColorTest extends \PHPUnit_Framework_TestCase
{

    public function testFunctionStringConversion()
    {

        $c = Color::get('hsl(50%, 50%, 100%)')->toHsl();

        $this->assertEquals(180, $c->getHue());

        $c = Color::get('hsl(-180, 50%, 100%)')->toHsl();

        $this->assertEquals(180, $c->getHue());

        $c = Color::get('hsl(-150%, 50%, 100%)')->toHsl();

        $this->assertEquals(180, $c->getHue());

        $c = Color::get('hsl(150%, 50%, 100%)')->toHsl();
        
        $this->assertEquals(180, $c->getHue());
        $this->assertEquals(.5, $c->getSaturation());
        $this->assertEquals(1.0, $c->getLightness());

        $c = Color::get('rgb(34.23%, 20%, 120)')->toRgb();

        $this->assertEquals(87, $c->getRed());
        $this->assertEquals(51, $c->getGreen());
        $this->assertEquals(120, $c->getBlue());

        $c = Color::get('hsla(0.872664626rad, .4, 90%, 22.3%)')->toHsla();

        $this->assertEquals(50, $c->getHue());
        $this->assertEquals(.4, $c->getSaturation());
        $this->assertEquals(.9, $c->getLightness());
        $this->assertEquals(.223, $c->getAlpha());
    }
}