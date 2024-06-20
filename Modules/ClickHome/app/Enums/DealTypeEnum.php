<?php

namespace Modules\ClickHome\Enums;

enum DealTypeEnum: string
{
    case SELL = 'sell';
    case RENT_LONG = 'rent_long';
    case RENT_DAILY = 'rent_daily';
    case REST = 'rest';

    public static function toArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->value] = $case->name;
        }
        return $array;
    }

    public static function labelArray(): array
    {
        $array = [];
        foreach (self::cases() as $case) {
            $array[$case->value] = __('messages.dealtypes.'.$case->value);
        }
        return $array;
    }
}
