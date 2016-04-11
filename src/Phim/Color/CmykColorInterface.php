<?php

namespace Phim\Color;

use Phim\ColorInterface;

interface CmykColorInterface extends ColorInterface
{

    public function getCyan();
    public function withCyan($cyan);

    public function getMagenta();
    public function withMagenta($magenta);

    public function getYellow();
    public function withYellow($yellow);

    public function getKey();
    public function withKey($key);
}