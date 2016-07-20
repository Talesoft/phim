<?php
declare(strict_types=1);

namespace Phim\Color;

use Phim\ColorInterface;

trait ColorizableTrait
{

    protected $color = null;

    /**
     * @TODO: Union return type
     * @return ColorInterface|null
     */
    public function getColor()
    {

        return $this->color;
    }

    public function withColor(ColorInterface $color): ColorizableInterface
    {

        $object = clone $this;
        $object->color = clone $color;
        
        return $object;
    }
}