<?php

namespace Phim;

use Phim\Path\Anchor;

class Path implements PathInterface
{
    use PathTrait;

    public function __construct(array $anchors = null)
    {

        if ($anchors) {

            foreach ($anchors as $a) {

                $this->addAnchor($a);
            }
        }
    }

    public static function fromPoints(array $points)
    {

        return new Path(array_map(function (PointInterface $point) {

            return Anchor::fromPoint($point);
        }, $points));
    }
}