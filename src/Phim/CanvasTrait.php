<?php

namespace Phim;

use Phim\Canvas\Layer;
use Phim\Canvas\LayerInterface;

/**
 * Class CanvasTrait
 *
 * @package Phim
 */
trait CanvasTrait
{
    use SizeTrait;

    /**
     * @var LayerInterface[]
     */
    private $layers = [];

    /**
     * @return LayerInterface[]
     */
    public function getLayers()
    {

        return $this->layers;
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function hasLayer($name)
    {

        return isset($this->layers[$name]);
    }

    /**
     * @param $name
     *
     * @return LayerInterface
     */
    public function getLayer($name)
    {

        return $this->layers[$name];
    }

    /**
     * @param $name
     *
     * @return LayerInterface
     */
    public function createLayer($name)
    {

        $layer = new Layer;
        $this->layers[$name] = $layer;

        return $layer;
    }
}