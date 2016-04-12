<?php

namespace Phim\Engine\Context;

use Phim\Engine\ContextInterface;

interface FilterContextInterface extends ContextInterface
{

    public function getFilter();
    public function filter();
}