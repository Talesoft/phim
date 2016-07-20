<?php
declare(strict_types=1);

namespace Phim\Color;

interface HsvColorInterface extends HsColorInterface
{

    public function getValue(): float;
    public function withValue(float $value);
}