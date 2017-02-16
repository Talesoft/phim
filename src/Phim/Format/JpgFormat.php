<?php

namespace Phim\Format;

use Phim\FormatInterface;

class JpgFormat implements FormatInterface
{
    use CompressionLevelTrait;

    public function getExtension()
    {

        return 'jpg';
    }
}