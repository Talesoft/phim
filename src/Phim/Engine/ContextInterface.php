<?php

namespace Phim\Engine;


/**
 * Canvas
 *  \- Layer
 *  |  \- Shape
 *  |  |- Shape
 *  |  |- Shape
 *  |  |- Transformation
 *  |  |- Transformation
 *  |  |- Filter
 *  |  |- Filter
 *  |- Layer
 *  |- Layer
 */

interface ContextInterface
{

    public function getEngine();
    public function draw();
}