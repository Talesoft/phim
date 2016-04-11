<?php

namespace Phim\Color;

trait CmykColorTrait
{

    protected $cyan = 0;
    protected $magenta = 0;
    protected $yellow = 0;
    protected $key = 0;

    /**
     * @return int
     */
    public function getCyan()
    {

        return $this->cyan;
    }

    /**
     * @param int $cyan
     * @return $this
     */
    public function withCyan($cyan)
    {

        $color = clone $this;
        $color->cyan = $cyan;
        return $this;
    }

    /**
     * @return int
     */
    public function getMagenta()
    {

        return $this->magenta;
    }

    /**
     * @param int $magenta
     * @return $this
     */
    public function withMagenta($magenta)
    {

        $color = clone $this;
        $color->magenta = $magenta;
        return $this;
    }

    /**
     * @return int
     */
    public function getYellow()
    {

        return $this->yellow;
    }

    /**
     * @param int $yellow
     * @return $this
     */
    public function withYellow($yellow)
    {

        $color = clone $this;
        $color->yellow = $yellow;
        return $this;
    }

    /**
     * @return int
     */
    public function getKey()
    {

        return $this->key;
    }

    /**
     * @param int $key
     * @return $this
     */
    public function withKey($key)
    {

        $color = clone $this;
        $color->key = $key;
        return $this;
    }
}