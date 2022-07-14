<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class MailNoti extends Enum
{
    const NOT_ACCEPT = 0;
    const RECEUVE = 1;
    public static function getDescription($value): string
    {
        switch ($value) {
            case self::UN_PUBLISH:
                return '受け取る';
                break;
            case self::PUBLISH:
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
