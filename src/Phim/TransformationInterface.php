<?php

namespace Phim;

use Phim\Path\AnchorInterface;

/**
 * Interface TransformationInterface
 *
 * @package Phim
 */
interface TransformationInterface
{

    /**
     * @return float
     */
    public function getA();

    /**
     * @return float
     */
    public function getB();

    /**
     * @return float
     */
    public function getC();

    /**
     * @return float
     */
    public function getD();

    /**
     * @return float
     */
    public function getTx();

    /**
     * @return float
     */
    public function getTy();

    /**
     * @param $x
     * @param $y
     *
     * @return $this
     */
    public function translate($x, $y);

    /**
     * @param      $x
     * @param null $y
     *
     * @return $this
     */
    public function scale($x, $y = null);

    /**
     * @param $degrees
     *
     * @return $this
     */
    public function rotate($degrees);

    /**
     * @param $x
     * @param $y
     *
     * @return $this
     */
    public function skew($x, $y);

    /**
     * @return $this
     */
    public function invert();

    /**
     * @param TransformationInterface $other
     *
     * @return $this
     */
    public function multiply(TransformationInterface $other);

    /**
     * @return float
     */
    public function getDeterminant();

    /**
     * @param PointInterface $point
     * @param PointInterface $origin
     *
     * @return PointInterface
     */
    public function transformPoint(PointInterface $point, PointInterface $origin = null);

    /**
     * @param AnchorInterface $anchor
     * @param PointInterface  $origin
     *
     * @return AnchorInterface
     */
    public function transformAnchor(AnchorInterface $anchor, PointInterface $origin = null);

    /**
     * @return string
     */
    public function __toString();
}