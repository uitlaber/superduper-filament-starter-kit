<?php

namespace Modules\ClickHome\Enums;

enum CurrencyEnum: string
{
    case USD = 'usd';
    case RUB = 'rub';

    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->value] = $case->name;
        }
        return $array;
    }
}
