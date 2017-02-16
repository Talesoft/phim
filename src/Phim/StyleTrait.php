<?php

namespace Phim;

trait StyleTrait
{

    private $strokeColor = null;
    private $strokeWidth = 1;

    private $fillColor = null;

    /**
     * @return mixed
     */
    public function getStrokeColor()
    {

        return $this->strokeColor;
    }

    /**
     * @param ColorInterface $strokeColor
     *
     * @return $this
     */
    public function setStrokeColor(ColorInterface $strokeColor)
    {

        $this->strokeColor = $strokeColor;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStrokeWidth()
    {

        return $this->strokeWidth;
    }

    /**
     * @param int $strokeWidth
     *
     * @return $this
     */
    public function setStrokeWidth($strokeWidth)
    {

        $this->strokeWidth = $strokeWidth;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFillColor()
    {

        return $this->fillColor;
    }

    /**
     * @param ColorInterface $fillColor
     *
     * @return $this
     */
    public function setFillColor(ColorInterface $fillColor)
    {

        $this->fillColor = $fillColor;

        return $this;
    }
}