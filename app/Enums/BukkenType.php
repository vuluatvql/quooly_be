<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class BukkenType extends Enum
{
    const APARTMENT = 1;
    const BUILDING_APARTMENT = 2;
    const DETACHED_HOURSE = 3;
    const SELECTIONAL_APARTMENT = 4;
    const LAND = 5;
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::APARTMENT:
                return ' 1棟マンション';
                break;
            case self::BUILDING_APARTMENT:
                return '1棟アパート';
                break;
            case self::DETACHED_HOURSE:
                return '戸建';
                break;
            case self::SELECTIONAL_APARTMENT:
                return '区分マンション';
                break;
            case self::LAND:
                return '土地';
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
