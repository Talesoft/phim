<?php

namespace Phim;

use Phim\Path\AnchorInterface;

trait PathTrait
{

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
}