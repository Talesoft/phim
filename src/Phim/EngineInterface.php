<?php

namespace Phim;

interface EngineInterface
{

    public function getSupportedFormats();
    public function isAvailable();
    public function render(CanvasInterface $canvas, FormatInterface $format);
}