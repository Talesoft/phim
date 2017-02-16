<?php

namespace Phim;

interface TransformationInterface
{

    public function getA();
    public function getB();
    public function getC();
    public function getD();
    public function getTx();
    public function getTy();
    
    public function translate($x, $y);
    public function scale($x, $y = null);
    public function rotate($degrees);
    public function skew($x, $y);

    public function invert();
    public function multiply(TransformationInterface $other);
    public function getDeterminant();

    public function transformPoint(PointInterface $point);

    public function __toString();
}