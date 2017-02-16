<?php

namespace Phim;

trait ShapeTrait
{

    private $path = null;
    private $style = null;

    public function getPath()
    {

        return $this->path;
    }

    public function setPath(PathInterface $path)
    {

        $this->path = $path;

        return $this;
    }

    /**
     * @return StyleInterface
     */
    public function getStyle()
    {

        return $this->style;
    }

    /**
     * @param StyleInterface $style
     *
     * @return $this
     */
    public function setStyle(StyleInterface $style)
    {

        $this->style = $style;

        return $this;
    }
}