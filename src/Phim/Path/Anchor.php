<?php

namespace Phim\Path;

use Phim\PointInterface;
use Phim\TransformationInterface;

class Anchor implements AnchorInterface
{
    use AnchorTrait;
    
    public function __construct($x, $y, array $controlPoints = null)
    {

        $this->setX($x);
        $this->setY($y);

        if ($controlPoints) {

            foreach ($controlPoints as $controlPoint) {

                $this->addControlPoint($controlPoint);
            }
        }
    }

    public static function fromPoint(PointInterface $point, array $controlPoints = null)
    {

        return new Anchor($point->getX(), $point->getY(), $controlPoints);
    }
}