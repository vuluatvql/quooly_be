<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class MailNoti extends Enum
{
    const RECEUVE = 1;
    const NOT_ACCEPT = 0;
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::RECEUVE:
                return '受け取る';
                break;
            case self::NOT_ACCEPT:
                return '受け取らない';
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
