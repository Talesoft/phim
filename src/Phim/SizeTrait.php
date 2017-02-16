<?php

namespace Phim;

trait SizeTrait
{

    private $width = 0;
    private $height = 0;

    /**
     * @return int
     */
    public function getWidth()
    {

        return $this->width;
    }

    /**
     * @param int $width
     *
     * @return $this
     */
    public function setWidth($width)
    {

        $this->width = $width;

        return $this;
    }

    /**
     * @return int
     */
    public function getHeight()
    {

        return $this->height;
    }

    /**
     * @param int $height
     *
     * @return $this
     */
    public function setHeight($height)
    {

        $this->height = $height;

        return $this;
    }
}