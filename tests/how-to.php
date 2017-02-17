<?php

use Phim\Canvas;
use Phim\Color;
use Phim\Engine\GdEngine;
use Phim\Factory;
use Phim\Format\PngFormat;
use Phim\Geometry\Line;
use Phim\Geometry\Rectangle;
use Phim\Shape\Geometric\LineShape;
use Phim\Shape\Geometric\RectangleShape;
use Phim\Style;
use Phim\Transformation;

include __DIR__.'/../vendor/autoload.php';

$rot = $_GET['rot'] ? (int)$_GET['rot'] : 0;

$ph = new Factory();

//Create basic image and draw a circle on it and save it to a PNG file

//Factory Style
$canvas = $ph->create($ph->size(200, 200));

$canvas->createLayer('rect')->add(
    $rect = $ph->rect(
        $ph->point(50, 50),
        $ph->size(100, 100),
        $ph->style(['origin' => '.5, .5'])->setFillColor(Color::get(Color::RED))
    )
);

$canvas->createLayer('line')->add(
    $ph->line(
        $ph->point(10, 10),
        $ph->point(190, 190),
        $ph->style(['stroke' => 'blue', 'stroke_width' => 4])
    )
);

$rect->getStyle()->addTransformation(Transformation::createIdentity()->rotate($rot));

//OO-Style
$ooCanvas = new Canvas(200, 200);
$background = $ooCanvas->createLayer('background');
$background->add(new RectangleShape(
    new Rectangle(10, 10, 100, 50),
    new Style(['fill_color' => 'red'])
))->add(new LineShape(
    new Line(10, 10, 190, 190),
    new Style(['stroke_color' => 'blue', 'stroke_width' => 4])
));


$engine = new GdEngine();
header('Content-Type: image/png');
echo $engine->render($canvas, new PngFormat);