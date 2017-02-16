<?php

namespace Phim;

use Phim\Canvas\LayerInterface;

interface CanvasInterface extends SizeInterface
{
    
    /**
     *
     * @return LayerInterface[]
     */
    public function getLayers();

    /**
     * @param $name
     *
     * @return bool
     */
    public function hasLayer($name);

    /**
     * @param $name
     *
     * @return LayerInterface
     */
    public function getLayer($name);

    /**
     * @param $name
     *
     * @return LayerInterface
     */
    public function createLayer($name);
}