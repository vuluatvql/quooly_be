<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PublishFlag extends Enum
{
    const UN_PUBLISH = 0;
    const PUBLISH = 1;
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::UN_PUBLISH:
                return '無効';
                break;
            case self::PUBLISH:
                return '有効';
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
