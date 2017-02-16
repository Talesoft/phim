<?php

namespace Phim\Format;

use Phim\FormatInterface;

class PngFormat implements FormatInterface
{

    public function getExtension()
    {

        return 'png';
    }
}