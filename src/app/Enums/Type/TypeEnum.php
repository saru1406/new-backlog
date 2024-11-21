<?php

namespace App\Enums\Type;

enum TypeEnum: string
{
    case TASK = 'タスク';
    case ISSUE = '課題';
    case TODO = 'TODO';

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
