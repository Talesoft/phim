<?php

namespace Phim;

use Phim\Point\PointDataInterface;

interface EngineInterface
{

    public function create(Size $size, ColorInterface $background = null);

    public function color($string);
    public function image($path);
    public function point($x, $y);
    public function size($width, $height);
    public function line(PointDataInterface $from, PointDataInterface $to, BrushInterface $brush);
    public function triangle(PointDataInterface $a, PointDataInterface $b, PointDataInterface $c, BrushInterface $brush);
    public function rect(PointDataInterface $position, PointDataInterface $size, BrushInterface $brush);
    public function poly(array $points, BrushInterface $brush);
    public function square(PointDataInterface $position, $sideLength, BrushInterface $brush);
    public function circle(PointDataInterface $center, $radius, BrushInterface $brush);
    public function ellipse(PointDataInterface $center, PointDataInterface $size, BrushInterface $brush );
    public function arc(PointDataInterface $center, PointDataInterface $size, $startAngle, $endAngle, BrushInterface $brush);

    public function fillBrush($color);
    public function strokeBrush($color);
}