<?php
declare(strict_types=1);

namespace Phim\Style\DrawStyle;

use Phim\Color\ColorizableInterface;
use Phim\Style\DrawStyleInterface;

interface FillDrawStyleInterface extends DrawStyleInterface, ColorizableInterface
{
}