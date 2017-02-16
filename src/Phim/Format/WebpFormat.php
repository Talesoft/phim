<?php

namespace Phim\Format;

use Phim\FormatInterface;

class WebpFormat implements FormatInterface
{

    public function getExtension()
    {

        return 'webp';
    }
}