<?php

namespace Phim;

use Phim\Exception\Runtime\ZeroDivisionException;
use Phim\Path\Anchor;
use Phim\Path\AnchorInterface;
use Phim\Point;
use Phim\Point\PointDataInterface;

/**
 * Class Transformation
 *
 * @package Phim
 */
class Transformation implements TransformationInterface
{

    /**
     * @var float
     */
    private $a;

    /**
     * @var float
     */
    private $b;

    /**
     * @var float
     */
    private $c;

    /**
     * @var float
     */
    private $d;

    /**
     * @var float
     */
    private $tx;

    /**
     * @var float
     */
    private $ty;

    /**
     * | A  C  Tx |
     * | B  D  Ty |
     * | 0  0  1  |
     *
     * @param float $a
     * @param float $b
     * @param float $c
     * @param float $d
     * @param float $tx
     * @param float $ty
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
     * @return float
     */
    public function getA()
    {

        return $this->a;
    }

    /**
     * @return float
     */
    public function getB()
    {

        return $this->b;
    }

    /**
     * @return float
     */
    public function getC()
    {

        return $this->c;
    }

    /**
     * @return float
     */
    public function getD()
    {

        return $this->d;
    }

    /**
     * @return float
     */
    public function getTx()
    {

        return $this->tx;
    }

    /**
     * @return float
     */
    public function getTy()
    {

        return $this->ty;
    }


    /**
     * @param $x
     * @param $y
     *
     * @return $this
     */
    public function translate($x, $y)
    {

        $this->tx += $x;
        $this->ty += $y;

        return $this;
    }

    /**
     * @param      $x
     * @param null $y
     *
     * @return $this
     */
    public function scale($x, $y = null)
    {

        return $this->multiply(new self($x, 0, 0, $y !== null ? $y : $x, 0, 0));
    }

    /**
     * @param $degrees
     *
     * @return $this
     */
    public function rotate($degrees)
    {

        $a = deg2rad($degrees);
        $cosA = cos($a);
        $sinA = sin($a);

        return $this->multiply(new self($cosA, $sinA, -$sinA, $cosA, 0, 0));
    }

    /**
     * @param      $x
     * @param null $y
     *
     * @return $this
     */
    public function skew($x, $y = null)
    {

        return $this->multiply(new self(
            1,
            tan(deg2rad($y)),
            tan(deg2rad($x !== null ? $x : $y)),
            1,
            0,
            0
        ));
    }

    /**
     * @return $this
     */
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

    /**
     * @param TransformationInterface $other
     *
     * @return $this
     */
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

    /**
     * @param PointInterface $point
     *
     * @param PointInterface $origin
     *
     * @return PointInterface
     */
    public function transformPoint(PointInterface $point, PointInterface $origin = null)
    {

        $x = $point->getX();
        $y = $point->getY();

        if ($origin) {

            $x += $origin->getX();
            $y += $origin->getY();
        }

        $x = $this->a * $x + $this->c * $y + $this->tx;
        $y = $this->b * $x + $this->d * $y + $this->ty;

        if ($origin) {

            $x -= $origin->getX();
            $y -= $origin->getY();
        }

        return new Point($x, $y);
    }

    /**
     * @param AnchorInterface $anchor
     *
     * @param PointInterface  $origin
     *
     * @return AnchorInterface
     */
    public function transformAnchor(AnchorInterface $anchor, PointInterface $origin = null)
    {

        return Anchor::fromPoint($this->transformPoint($anchor, $origin), array_map(function (PointInterface $point) use ($origin) {

            return $this->transformPoint($point, $origin);
        }, $anchor->getControlPoints()));
    }

    /**
     * @return float
     */
    public function getDeterminant()
    {

        return ($this->a * $this->d) - ($this->b * $this->c);
    }

    /**
     * @return string
     */
    public function __toString()
    {

        return "matrix({$this->a},{$this->b},{$this->c},{$this->d},{$this->tx},{$this->ty})";
    }

    /**
     * @return TransformationInterface
     */
    public static function createIdentity()
    {

        return new static(1, 0, 0, 1, 0, 0);
    }
}