<?php
declare(strict_types=1);

namespace Phim\Color;

use Phim\ColorInterface;

interface RgbColorInterface extends ColorInterface
{

    public function getRed(): int;
    public function withRed(int $red): RgbColorInterface;

    public function getBlue(): int;
    public function withBlue(int $blue): RgbColorInterface;

    public function getGreen(): int;
    public function withGreen(int $green): RgbColorInterface;
}