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

    public function translate($x, $y)
    {

        $this->tx += $x;
        $this->ty += $y;

        return $this;
    }

    public function scale($x, $y = null)
    {

        return $this->multiply(new self($x, 0, 0, $y !== null ? $y : $x, 0, 0));
    }

    public function rotate($degrees)
    {

        $a = deg2rad($degrees);
        $cosA = cos($a);
        $sinA = sin($a);

        return $this->multiply(new self($cosA, $sinA, -$sinA, $cosA, 0, 0));
    }

    public function skew($x, $y = null)
    {

        return $this->multiply(new self(
            1, tan(deg2rad($x)), tan(deg2rad($y !== null ? $y : $x)),
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

        $this->a = $this->a * $other->getA() + $this->c * $other->getB();
        $this->b = $this->b * $other->getA() + $this->d * $other->getB();
        $this->c = $this->a * $other->getC() + $this->c * $other->getD();
        $this->d = $this->b * $other->getC() + $this->d * $other->getD();
        $this->tx = $this->a * $other->getTx() + $this->c * $other->getTy() + $this->tx;
        $this->ty = $this->b * $other->getTx() + $this->d * $other->getTy() + $this->ty;
        
        return $this;
    }

    public function transformPoint(PointInterface $point)
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