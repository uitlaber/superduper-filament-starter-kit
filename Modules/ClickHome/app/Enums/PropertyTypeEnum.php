<?php

namespace Modules\ClickHome\Enums;

enum PropertyTypeEnum: string
{
    case TEXT = 'text';
    case NUMBER = 'number';
    case RADIO = 'radio';
    case CHECKBOX = 'checkbox';
    case SWITCH = 'switch';

    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->value] = $case->name;
        }
        return $array;
    }
}
