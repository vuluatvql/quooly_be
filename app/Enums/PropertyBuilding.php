<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PropertyBuilding extends Enum
{
    const OPT_ONE =   1;
    const OPT_TWO =   2;
    const OPT_THREE = 3;

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::OPT_ONE:
                return 'option 1';
                break;
            case self::OPT_TWO:
                return 'option 2';
                break;
            case self::OPT_THREE:
                return 'option 3';
                break;
            default:
                return "";
                break;
        }
    }
    public static function parseArray()
    {
        $data = [];
        foreach (self::getValues() as $value) {
            $data[] = ['label' => self::getDescription($value), 'value' => $value];
        }
        return $data;
    }

    public static function descriptionArray()
    {
        $descriptions = [];
        foreach (self::getKeys() as $value) {
            $descriptions[] = self::getDescription(self::getValue($value));
        }
        return $descriptions;
    }
    public static function getValueByDescription($description)
    {
        foreach (self::getKeys() as $value) {
            if (self::getDescription(self::getValue($value)) == $description) {
                return self::getValue($value);
            }
        }
        return null;
    }
}
