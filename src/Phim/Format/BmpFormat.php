<?php

namespace Phim\Format;

use Phim\FormatInterface;

class BmpFormat implements FormatInterface
{

    public function getExtension()
    {

        return 'bmp';
    }
}