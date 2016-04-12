<?php


use Phim\Engine\GdEngine;

$phim = new GdEngine();

//Create basic image and draw a circle on it and save it to a PNG file
//Using: Implicit layer management, Engine shortcuts
$canvas = $phim->create($phim->size(200, 200), $phim->color('#000'));
$canvas->draw(
    $phim->circle(
        $phim->point(100, 100),
        100,
        $phim->fillBrush('#f00')
    )
);

//Or in OO style
$canvas = new Canvas(new Size(200, 200), Color::fromString('#000'));
$canvas->draw(
    new Circle(
        new Point(100, 100),
        100,
        new FillBrush('#f00')
    )
);


//THESE METHODS BELOW ARE THE ONLY PARTS WHERE STUFF ACTUALLY GETS HANDLED THROUGH GD AND IMAGICK
//Everything else is virtual!

//Format detection based on extension (by default)
$engine->save($canvas, $path);
//Explicit conversion in two ways
$engine->save($canvas, $path, 'png');
$engine->save($canvas, $path, FileFormat::PNG);
//Save with compression options etc.
$engine->save($canvas, $path, 'png', new PngSaveOptions(['compression_level' => 9]));

//Get raw output
$output = $engine->render($canvas);

//Pass to client directly
$engine->render($canvas, true);






//Layer management

$backgroundLayer = $canvas->getBackgroundLayer(); //Which is also the layer you draw on with implicit layering

$canvas->layer('example')
    ->draw($phim->square($canvas->getCenter(), 100, $phim->strokeBrush('yellow')))
    ->mask($canvas->mask()->draw($phim->circle($canvas->getCenter, 50, $phim->fillBrush('#fff'))));

$canvas->layer('other-example')->draw(/*...*/);

$canvas->layer('example')->draw(/*...*/);

//save/render


//Apply filters and transformations

$layer->transform($phim->transform()->rotate(24)->translate($phim->point(2, 2)));

$layer->filter($phim->colorize()->withHue(234))->filter(new NegationFilter())->filter(new ContrastFilter(.5));


//Extend with own brushes and filters

class CustomBrush implements \Phim\BrushInterface
{

    public function draw(EngineInterface $engine, LayerContextInterface $layerContext, \Phim\GeometryInterface $geometry)
    {

        if ($engine->isGd()) {

            if ($geo instanceof CircleInterface) {

                //Draw circle
            } else if ($geo instanceof RectangleInterface) {

                //Draw rectangle
            }
            //Notice that only BASIC shapes actually need to be handled, since everything else can be represented with a polygon
            //(Everything could, but performance...)
        }
    }

    public function getDrawMethods()
    {

        return [GdEngine::class => 'drawGd', ImagickEngine::class => 'drawImagick'];
    }
}