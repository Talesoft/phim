<?php
declare(strict_types=1);

namespace Phim\Color;

use Phim\ColorInterface;

interface ColorizableInterface
{

    /**
     * @TODO: Union return type
     * @return ColorInterface|null
     */
    public function getColor();

    public function withColor(ColorInterface $color): ColorizableInterface;
}