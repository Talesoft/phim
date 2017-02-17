<?php

namespace Phim;

use Phim\Geometry\Rectangle;
use Phim\Path\AnchorInterface;

trait PathTrait
{

    /**
     * @var AnchorInterface[]
     */
    private $anchors = [];

    public function getAnchors()
    {

        return $this->anchors;
    }

    public function addAnchor(AnchorInterface $anchor)
    {

        $this->anchors[] = $anchor;

        return $this;
    }

    public function removeAnchor(AnchorInterface $anchor)
    {

        $this->anchors = array_filter($this->anchors, function (AnchorInterface $a) use ($anchor) {

            return $a === $anchor;
        });

        return $this;
    }

    public function getBounds()
    {

        $lowestX = $highestX = $lowestY = $highestY = null;

        foreach ($this->anchors as $anchor) {

            if ($lowestX === null || $anchor->getX() < $lowestX)
                $lowestX = $anchor->getX();

            if ($highestX === null || $anchor->getX() > $highestX)
                $highestX = $anchor->getX();

            if ($lowestY === null || $anchor->getY() < $lowestY)
                $lowestY = $anchor->getY();

            if ($highestY === null || $anchor->getY() > $highestY)
                $highestY = $anchor->getY();
        }

        return new Rectangle(
            $lowestX,
            $lowestY,
            $highestX - $lowestX,
            $highestY - $lowestY
        );
    }
}