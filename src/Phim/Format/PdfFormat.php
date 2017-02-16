<?php

namespace Phim\Format;

use Phim\FormatInterface;

class PdfFormat implements FormatInterface
{

    public function getExtension()
    {

        return 'pdf';
    }
}