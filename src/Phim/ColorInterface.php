<?php

namespace Phim;

interface ColorInterface
{

    public function withAlphaSupport();
    
    public function getRgb();
    public function getCmyk();
    public function getHsl();
    public function getHsv();

    public function __toString();
}