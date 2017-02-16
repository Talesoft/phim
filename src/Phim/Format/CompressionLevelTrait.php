<?php

namespace Phim\Format;

trait CompressionLevelTrait
{

    private $compressionLevel = 0;

    /**
     * @return int
     */
    public function getCompressionLevel()
    {

        return $this->compressionLevel;
    }

    /**
     * @param int $compressionLevel
     *
     * @return $this
     */
    public function setCompressionLevel($compressionLevel)
    {

        $this->compressionLevel = $compressionLevel;

        return $this;
    }
}