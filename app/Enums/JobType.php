<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class JobType extends Enum
{
    const JOB_ONE =   1;
    const JOB_TWO =   2;
    const JOB_THREE = 3;

    public static function getDescription($value): string
    {
        switch ($value) {
            case self::JOB_ONE:
                return ' 仕事1';
                break;
            case self::JOB_TWO:
                return '仕事2';
                break;
            case self::JOB_THREE:
                return '仕事3';
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
