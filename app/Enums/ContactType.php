<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ContactType extends Enum
{
    const USER = 1;
    const READ_ESTATE_USER = 2;
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::USER:
                return 'ユーザー';
                break;
            case self::READ_ESTATE_USER:
                return '不動産ユーザーID';
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
}
