<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class BukkenStructure extends Enum
{
    const RC = 1;
    const STEEL_FRAME = 2;
    const STEEL_STRUCTURE = 3;
    const WOODEN = 4;
    const DONT_WORRY = 5;
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::RC:
                return 'RC造（SRC造を含む）';
                break;
            case self::STEEL_FRAME:
                return '鉄骨造';
                break;
            case self::STEEL_STRUCTURE:
                return '軽量鉄骨造';
                break;
            case self::WOODEN:
                return '木造';
                break;
            case self::DONT_WORRY:
                return 'こだわらない';
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
            $data[] = ['label' => self::getDescription($value), 'id' => $value];
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
