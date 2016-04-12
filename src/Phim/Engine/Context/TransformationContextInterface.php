<?php

namespace Phim\Engine\Context;

use Phim\Engine\ContextInterface;

interface TransformationContextInterface extends ContextInterface
{

    public function getTransformation();
    public function transform();
}