<?php
declare(strict_types=1);

namespace Phim\Color;

use Phim\Util\MathUtil;

trait AlphaTrait
{

    protected $alpha = 1.0;

    /**
     * @return float
     */
    public function getAlpha(): float
    {

        return $this->alpha;
    }

    /**
     * @param float $alpha
     * @return $this|AlphaColorInterface
     */
    public function withAlpha(float $alpha): AlphaColorInterface
    {

        $color = clone $this;
        $color->alpha = MathUtil::capFloat($alpha);

        return $color;
    }
}