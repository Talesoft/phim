<?php

namespace Phim;

use Phim\Geometry\Arc;
use Phim\Geometry\Circle;
use Phim\Geometry\Ellipse;
use Phim\Geometry\Line;
use Phim\Geometry\Rectangle;
use Phim\Shape\Geometric\ArcShape;
use Phim\Shape\Geometric\CircleShape;
use Phim\Shape\Geometric\EllipseShape;
use Phim\Shape\Geometric\LineShape;
use Phim\Shape\Geometric\RectangleShape;

trait FactoryTrait
{

    public function create(SizeInterface $size)
    {

        return new Canvas($size->getWidth(), $size->getHeight());
    }

    public function color($color)
    {

        return Color::get($color);
    }

    public function image($path)
    {

        //TODO: implement
    }
    
    public function style(array $options = null)
    {
        
        return new Style($options);
    }

    public function point($x, $y)
    {

        return new Point($x, $y);
    }

    public function size($width, $height)
    {

        return new Size($width, $height);
    }

    public function line(PointInterface $from, PointInterface $to, StyleInterface $style = null)
    {

        return new LineShape(new Line($from->getX(), $from->getY(), $to->getX(), $to->getY()), $style);
    }

    public function triangle(PointInterface $a, PointInterface $b, PointInterface $c, StyleInterface $style = null)
    {

        return $this->poly([$a, $b, $c], $style);
    }

    public function rect(PointInterface $position, SizeInterface $size, StyleInterface $style = null)
    {

        return new RectangleShape(
            new Rectangle($position->getX(), $position->getY(), $size->getWidth(), $size->getHeight()),
            $style
        );
    }

    public function poly(array $points, StyleInterface $style = null)
    {

        return new Shape(Path::fromPoints($points), $style);
    }

    public function square(PointInterface $position, $sideLength, StyleInterface $style = null)
    {

        return $this->rect($position, new Size($sideLength, $sideLength), $style);
    }

    public function circle(PointInterface $position, $radius, StyleInterface $style = null)
    {

        return new CircleShape(new Circle($position->getX(), $position->getY(), $radius), $style);
    }

    public function ellipse(PointInterface $position, $radiusX, $radiusY, StyleInterface $style = null)
    {

        return new EllipseShape(new Ellipse($position->getX(), $position->getY(), $radiusX, $radiusY), $style);
    }

    public function arc(PointInterface $position, $radiusX, $radiusY, $startAngle, $endAngle, StyleInterface $style = null)
    {

        return new ArcShape(
            new Arc($position->getX(), $position->getY(), $radiusX, $radiusY, $startAngle, $endAngle),
            $style
        );
    }
}