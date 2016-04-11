<?php

namespace Phim;

interface ColorInterface
{

    public function withAlphaSupport();
    public function withoutAlphaSupport();
    
    public function getRgb();
    public function getRgba();
    public function getHsl();
    public function getHsla();
    public function getHsv();
    public function getHsva();

    public function __toString();
}