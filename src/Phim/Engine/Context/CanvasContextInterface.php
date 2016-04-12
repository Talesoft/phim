<?php

namespace Phim\Engine\Context;

use Phim\Engine\ContextInterface;
use Phim\CanvasInterface;

interface CanvasContextInterface extends ContextInterface
{

    public function getCanvas();
    public function getLayerContext(CanvasInterface $layer);
    public function drawLayer(LayerContextInterface $layerContext);
    public function drawLayers();
}