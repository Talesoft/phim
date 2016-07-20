<?php
declare(strict_types=1);

namespace Phim\Color;

use Phim\Util\MathUtil;

trait HsColorTrait
{

    protected $hue = 0;
    protected $saturation = 0.0;

    /**
     * @return int
     */
    public function getHue(): int
    {

        return $this->hue;
    }

    /**
     * @param int $hue
     * @return $this|HsColorInterface
     */
    public function withHue(int $hue): HsColorInterface
    {

        $color = clone $this;
        $color->hue = MathUtil::rotateInt($hue, 360);

        return $color;
    }

    /**
     * @return float
     */
    public function getSaturation(): float
    {

        return $this->saturation;
    }

    /**
     * @param float $saturation
     * @return $this|HsColorInterface
     */
    public function withSaturation(float $saturation): HsColorInterface
    {

        $color = clone $this;
        $color->saturation = MathUtil::capFloat($saturation);

        return $color;
    }
}