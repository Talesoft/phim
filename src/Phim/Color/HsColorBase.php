<?php
declare(strict_types=1);

namespace Phim\Color;

use Phim\ColorBase;
use Phim\Util\MathUtil;

abstract class HsColorBase extends ColorBase  implements HsColorInterface
{
    use HsColorTrait;

    public function __construct(int $hue, float $saturation)
    {

        $this->hue = MathUtil::rotateInt($hue, 360);
        $this->saturation = MathUtil::capFloat($saturation);
    }
}