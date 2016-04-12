<?php

namespace Phim\Engine;

use Phim\EngineInterface;
use Phim\TransformationInterface;

interface TransformatorInterface
{

    public function transform(LayerContextInterface $engine, TransformationInterface $transformation);
}