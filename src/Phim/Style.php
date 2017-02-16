<?php

namespace Phim;

class Style implements StyleInterface
{
    use StyleTrait;

    const OPTION_STROKE_COLOR = 'stroke_color';
    const OPTION_STROKE_WIDTH = 'stroke_width';
    const OPTION_FILL_COLOR = 'fill_color';

    public function __construct(array $options = null)
    {

        if ($options) {

            self::applyOptions($this, $options);
        }
    }

    public static function applyOptions(StyleInterface $style, array $options)
    {
        
        foreach ($options as $name => $value) {
            
            switch ($name) {
                case self::OPTION_STROKE_COLOR:
                    $style->setStrokeColor(Color::get($value));
                    break;
                case self::OPTION_STROKE_WIDTH:
                    $style->setStrokeWidth((int)$value);
                    break;
                case self::OPTION_FILL_COLOR:
                    $style->setFillColor(Color::get($value));
                    break;
            }
        }

        return $style;
    }
}