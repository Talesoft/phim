<?php

namespace Phim;

use Phim\Path\AnchorInterface;

/**
 * Interface PathInterface
 *
 * @package Phim
 */
interface PathInterface
{

    /**
     * @return AnchorInterface[]
     */
    public function getAnchors();

    /**
     * @param AnchorInterface $anchor
     *
     * @return $this
     */
    public function addAnchor(AnchorInterface $anchor);

    /**
     * @param AnchorInterface $anchor
     *
     * @return $this
     */
    public function removeAnchor(AnchorInterface $anchor);
}