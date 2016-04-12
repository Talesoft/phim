<?php

namespace Phim\Text;

use Phim\Text\Font\StyleInterface;

interface FontInterface
{

    public function getPath();
    public function getStyle();
    public function setStyle(StyleInterface $style);
}