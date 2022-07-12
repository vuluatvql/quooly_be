<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ContactStatus extends Enum
{
    const NOT_SUPPORT = 0;
    const SUPPORTED = 1;
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::NOT_SUPPORT:
                return '未対応';
                break;
            case self::SUPPORTED:
                return '対応済み';
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
