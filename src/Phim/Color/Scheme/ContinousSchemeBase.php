<?php

namespace Phim\Color\Scheme;

use Phim\Color;
use Phim\ColorInterface;

abstract class ContinousSchemeBase extends Color\SchemeBase
{

    private $amount;
    private $step;

    /**
     * ContinousSchemeBase constructor.
     */
    public function __construct($baseColor, $amount, $step)
    {

        $this->amount = $amount;
        $this->step = $step;
        parent::__construct($baseColor);
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {

        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getStep()
    {

        return $this->step;
    }

    /**
     * @param ColorInterface $baseColor
     * @return \Generator
     */
    protected function generate(ColorInterface $baseColor)
    {

        yield $baseColor;
        for ($i = 1; $i <= $this->amount; $i++) {

            yield $this->generateStep($baseColor, $i, $this->step);
        }
    }

    abstract protected function generateStep(ColorInterface $baseColor, $i, $step);
}