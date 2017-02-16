<?php

namespace Phim\Engine;

use Phim\CanvasInterface;
use Phim\ColorInterface;
use Phim\EngineInterface;
use Phim\Format\PngFormat;
use Phim\FormatInterface;
use Phim\Path\AnchorInterface;

class GdEngine implements EngineInterface
{

    public function getSupportedFormats()
    {

        return [
            PngFormat::class
        ];
    }

    public function isAvailable()
    {

        return extension_loaded('gd');
    }
    
    private function allocate($im, ColorInterface $color)
    {
        
        $color = $color->toRgba();
        return imagecolorallocatealpha($im, $color->getRed(), $color->getGreen(), $color->getBlue(), (int)((1 - $color->getAlpha()) * 127));
    }

    public function render(CanvasInterface $canvas, FormatInterface $format)
    {

        if (!in_array(get_class($format), $this->getSupportedFormats()))
            throw new \InvalidArgumentException(
                "Passed format {$format->getExtension()} is not supported by ".get_class($this)
            );

        $im = imagecreatetruecolor($canvas->getWidth(), $canvas->getHeight());
        imagesavealpha($im, true);
        imagealphablending($im, false);
        foreach ($canvas->getLayers() as $layer) {

            foreach ($layer->getShapes() as $shape) {
                
                $style = $shape->getStyle();
                $fillColor = $style->getFillColor();
                $strokeColor = $style->getStrokeColor();

                if (!$fillColor && !$strokeColor)
                    continue;

                imagesetthickness($im, $style->getStrokeWidth());
                
                $path = $shape->getPath();
                
                //Convert anchors to simple polygon points for starters
                $points = [];
                $count = count($path->getAnchors());
                foreach ($path->getAnchors() as $anchor) {

                    //TODO: Apply transformations here
                    //TODO: Apply positionFilters here
                    $points[] = $anchor->getX();
                    $points[] = $anchor->getY();
                }

                if ($fillColor) {

                    $col = $this->allocate($im, $fillColor);
                    //TODO: Apply color filters here
                    imagefilledpolygon($im, $points, $count, $col);
                }

                if ($strokeColor) {

                    $col = $this->allocate($im, $strokeColor);
                    //TODO: Apply color filters here
                    //As imagepolygon doesn't draw open polygons and imageopenpolygon is too new, we iterate the anchors and draw lines
                    /** @var AnchorInterface $context */
                    $context = null;
                    foreach ($path->getAnchors() as $anchor) {

                        if ($context) {

                            imageline($im, $context->getX(), $context->getY(), $anchor->getX(), $anchor->getY(), $col);
                        }

                        $context = $anchor;
                    }
                }
            }
        }

        ob_start();
        switch (get_class($format)) {
            case PngFormat::class:

                imagepng($im);
                break;
        }

        return ob_get_clean();
    }
}