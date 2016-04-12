<?php

namespace Phim;

use Phim\Exception\Runtime\ZeroDivisionException;
use Phim\Point;
use Phim\Point\PointDataInterface;

class Transformation implements TransformationInterface
{

    private $a;
    private $b;
    private $c;
    private $d;
    private $tx;
    private $ty;

    /**
     * | A  C  Tx |
     * | B  D  Ty |
     * | 0  0  1  |
     */
    public function __construct($a, $b, $c, $d, $tx, $ty)
    {

        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
        $this->d = $d;
        $this->tx = $tx;
        $this->ty = $ty;
    }

    /**
     * @return mixed
     */
    public function getA()
    {

        return $this->a;
    }

    /**
     * @return mixed
     */
    public function getB()
    {

        return $this->b;
    }

    /**
     * @return mixed
     */
    public function getC()
    {

        return $this->c;
    }

    /**
     * @return mixed
     */
    public function getD()
    {

        return $this->d;
    }

    /**
     * @return mixed
     */
    public function getTx()
    {

        return $this->tx;
    }

    /**
     * @return mixed
     */
    public function getTy()
    {

        return $this->ty;
    }

    public function getArray()
    {

        return [$this->a, $this->b, $this->c, $this->d, $this->tx, $this->ty];
    }

    public function translate(PointDataInterface $by)
    {

        $m = clone $this;
        $m->tx += $by->getX();
        $m->ty += $by->getY();

        return $m;
    }

    public function scale($xFactor, $yFactor = null)
    {

        return $this->multiply(new self($xFactor, 0, 0, $yFactor !== null ? $yFactor : $xFactor, 0, 0));
    }

    public function rotate($degrees)
    {

        $a = rad2deg($degrees);
        $cosA = cos($a);
        $sinA = sin($a);

        return $this->multiply(new self($cosA, $sinA, -$sinA, $cosA, 0, 0));
    }

    public function skew($xDegrees, $yDegrees = null)
    {

        return $this->multiply(new self(
            1, tan(rad2deg($xDegrees)), tan(rad2deg($yDegrees !== null ? $yDegrees : $xDegrees)),
            1, 0, 0
        ));
    }

    public function invert()
    {

        $determinant = $this->getDeterminant();

        if ($determinant == 0)
            throw new ZeroDivisionException(
                'The matrix is not inversible since it would require a division through zero'
            );

        return new self(
            $this->d / $determinant,
            -$this->b / $determinant,
            -$this->c / $determinant,
            $this->a / $determinant,
            ($this->c * $this->ty) - ($this->d * $this->tx) / $determinant,
            (-$this->a * $this->ty) + ($this->b * $this->tx) / $determinant
        );
    }

    public function multiply(TransformationInterface $other)
    {

        return new self(
            $this->a * $other->getA() + $this->c * $other->getB(),
            $this->b * $other->getA() + $this->d * $other->getB(),
            $this->a * $other->getC() + $this->c * $other->getD(),
            $this->b * $other->getC() + $this->d * $other->getD(),
            $this->a * $other->getTx() + $this->c * $other->getTy() + $this->tx,
            $this->b * $other->getTx() + $this->d * $other->getTy() + $this->ty
        );
    }

    public function transformPoint(PointDataInterface $point)
    {

        $x = $point->getX();
        $y = $point->getY();

        return new Point(
            $this->a * $x + $this->c * $y + $this->tx,
            $this->b * $x + $this->d * $y + $this->ty
        );
    }

    public function getDeterminant()
    {

        return ($this->a * $this->d) - ($this->b * $this->c);
    }

    public function __toString()
    {

        return "matrix({$this->a},{$this->b},{$this->c},{$this->d},{$this->tx},{$this->ty})";
    }

    public static function createIdentity()
    {

        return new static(1, 0, 0, 0, 1, 0);
    }
}