<?php

namespace App\Enums\Priority;

enum PriorityEnum: string
{
    case LOW = '低';
    case MEDIUM = '中';
    case HIGH = '高';

    /**
     * 値を配列として返す
     *
     * @return array
     */
    public static function toArray(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }
}
