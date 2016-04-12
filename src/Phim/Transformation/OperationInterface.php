<?php

namespace Phim\Transformation;

use Phim\Point\PointDataInterface;

interface OperationInterface
{
    public function translate(PointDataInterface $by);
    public function scale($xFactor, $yFactor = null);
    public function skew($xDegrees, $yDegrees = null);
    public function rotate($degrees);
}