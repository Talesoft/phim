<?php

namespace Phim\Color;

class HsvaColor extends HsvColor implements HsvaColorInterface
{
    use HsvaColorTrait;

    public function __construct($hue, $saturation, $value, $alpha)
    {

        parent::__construct($hue, $saturation, $value);;

        $this->alpha = $alpha;
    }

    public function getRgba()
    {

        return $this->getRgb()->withAlphaSupport()->withAlpha($this->alpha);
    }

    public function getHsla()
    {

        return $this->getHsv()->withAlphaSupport()->withAlpha($this->alpha);
    }

    public function getHsva()
    {

        return new HslaColor($this->hue, $this->saturation, $this->value, $this->alpha);
    }

    public function __toString()
    {

        return "hsva({$this->hue},{$this->saturation},{$this->value},{$this->alpha})";
    }
}