<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class IndustryType extends Enum
{
    const INDUSTRY_ONE =   1;
    const INDUSTRY_TWO =   2;
    const INDUSTRY_THREE = 3;

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::INDUSTRY_ONE:
                return ' 業界1';
                break;
            case self::INDUSTRY_TWO:
                return '業界2';
                break;
            case self::INDUSTRY_THREE:
                return '業界3';
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
