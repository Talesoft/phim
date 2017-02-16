<?php

namespace Phim\Format;

use Phim\FormatInterface;

class GifFormat implements FormatInterface
{

    public function getExtension()
    {

        return 'gif';
    }
}