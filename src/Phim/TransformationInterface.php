<?php

namespace Phim;

use Phim\Point\PointDataInterface;

interface TransformationInterface
{

    public function getA();
    public function getB();
    public function getC();
    public function getD();
    public function getTx();
    public function getTy();
    public function getArray();

    public function invert();
    public function multiply(TransformationInterface $other);
    public function getDeterminant();

    public function transformPoint(PointDataInterface $point);

    public function __toString();
}