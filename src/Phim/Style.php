<?php

namespace Phim;

class Style implements StyleInterface
{
    use StyleTrait;

    const OPTION_STROKE_COLOR = 'stroke';
    const OPTION_STROKE_WIDTH = 'stroke_width';
    const OPTION_FILL_COLOR = 'fill';
    const OPTION_TRANSFORMATIONS = 'transform';
    const OPTION_TRANSFORM_ORIGIN = 'origin';
    const OPTION_FILTER = 'filter';

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
                    $style->setStrokeWidth((float)$value);
                    break;
                case self::OPTION_FILL_COLOR:
                    $style->setFillColor(Color::get($value));
                    break;
                case self::OPTION_TRANSFORMATIONS:
                    foreach (self::parseTransformations($value) as $trans) {

                        $style->addTransformation($trans);
                    }
                    break;
                case self::OPTION_TRANSFORM_ORIGIN:
                    $style->setTransformOrigin(self::parsePoint($value));
                    break;
                case self::OPTION_FILTER:
                    foreach (self::parseFilters($value) as $filter) {

                        $style->addFilter($filter);
                    }
                    break;
            }
        }

        return $style;
    }

    private static function parsePoint($value)
    {

        if ($value instanceof PointInterface)
            return $value;

        if (!is_array($value))
            $value = array_map('trim', explode(',', (string)$value));

        if (!count($value) === 2)
            throw new \RuntimeException(
                "Passed point array needs to consist of at least 2 values"
            );

        $value = array_values($value);
        return new Point((float)$value[0], (float)$value[1]);
    }

    private static function parseTransformations($value)
    {

        //TODO: parse transform expressions ("translate(10, 10) rotateY(5deg) skewX(5deg)")
        return [];
    }

    private static function parseFilters($value)
    {

        //TODO: Parse filter expressions ("blur(10) dropShadow(3, 3, .5)")
        return [];
    }
}