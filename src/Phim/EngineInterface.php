<?php

namespace Phim;

interface EngineInterface
{

    public function open($path);
    public function create(Size $size, ColorInterface $background = null);
}