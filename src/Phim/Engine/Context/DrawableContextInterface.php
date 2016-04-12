<?php

namespace Phim\Engine\Context;

use Phim\Engine\ContextInterface;

interface DrawableContextInterface extends ContextInterface
{

    public function getDrawable();
    public function draw();
}