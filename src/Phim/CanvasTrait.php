<?php

namespace Phim;

use Phim\Canvas\Layer;

trait CanvasTrait
{
    use SizeTrait;
    
    private $layers = [];
    
    public function getLayers()
    {

        return $this->layers;
    }

    public function hasLayer($name)
    {

        return isset($this->layers[$name]);
    }

    public function getLayer($name)
    {

        return $this->layers[$name];
    }

    public function createLayer($name)
    {

        $layer = new Layer;
        $this->layers[$name] = $layer;

        return $layer;
    }
}