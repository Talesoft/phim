<?php

namespace Phim\Brush;

use Phim\BrushInterface;
use Phim\Color\ColorizableInterface;

interface ColoredBrushInterface extends BrushInterface, ColorizableInterface
{

    public function getColor();
}