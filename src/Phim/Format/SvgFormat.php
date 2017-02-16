<?php

namespace Phim\Format;

use Phim\FormatInterface;

class SvgFormat implements FormatInterface
{

    public function getExtension()
    {

        return 'svg';
    }
}