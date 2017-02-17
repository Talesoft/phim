<?php

namespace Phim;

/**
 * Interface FactoryInterface
 *
 * @package Phim
 */
interface FactoryInterface
{

    /**
     * @param SizeInterface $size
     *
     * @return CanvasInterface
     */
    public function create(SizeInterface $size);

    /**
     * @param $color
     *
     * @return ColorInterface
     */
    public function color($color);

    /**
     * @param $path
     *
     * @return mixed
     */
    public function image($path);

    /**
     * @param $x
     * @param $y
     *
     * @return PointInterface
     */
    public function point($x, $y);

    /**
     * @param $width
     * @param $height
     *
     * @return SizeInterface
     */
    public function size($width, $height);

    /**
     * @param array $options
     *
     * @return StyleInterface
     */
    public function style(array $options = null);

    /**
     * @param array               $points
     * @param StyleInterface|null $style
     *
     * @return PathInterface
     */
    public function poly(array $points, StyleInterface $style = null);

    /**
     * @param PointInterface      $from
     * @param PointInterface      $to
     * @param StyleInterface|null $style
     *
     * @return ShapeInterface
     */
    public function line(PointInterface $from, PointInterface $to, StyleInterface $style = null);

    /**
     * @param PointInterface      $a
     * @param PointInterface      $b
     * @param PointInterface      $c
     * @param StyleInterface|null $style
     *
     * @return ShapeInterface
     */
    public function triangle(PointInterface $a, PointInterface $b, PointInterface $c, StyleInterface $style = null);

    /**
     * @param PointInterface      $position
     * @param SizeInterface       $size
     * @param StyleInterface|null $style
     *
     * @return ShapeInterface
     */
    public function rect(PointInterface $position, SizeInterface $size, StyleInterface $style = null);

    /**
     * @param PointInterface      $position
     * @param                     $sideLength
     * @param StyleInterface|null $style
     *
     * @return ShapeInterface
     */
    public function square(PointInterface $position, $sideLength, StyleInterface $style = null);

    /**
     * @param PointInterface      $position
     * @param                     $radius
     * @param StyleInterface|null $style
     *
     * @return ShapeInterface
     */
    public function circle(PointInterface $position, $radius, StyleInterface $style = null);

    /**
     * @param PointInterface      $position
     * @param                     $radiusX
     * @param                     $radiusY
     * @param StyleInterface|null $style
     *
     * @return ShapeInterface
     */
    public function ellipse(PointInterface $position, $radiusX, $radiusY, StyleInterface $style = null);

    /**
     * @param PointInterface      $position
     * @param                     $radiusX
     * @param                     $radiusY
     * @param                     $startAngle
     * @param                     $endAngle
     * @param StyleInterface|null $style
     *
     * @return ShapeInterface
     */
    public function arc(PointInterface $position, $radiusX, $radiusY, $startAngle, $endAngle, StyleInterface $style = null);
}