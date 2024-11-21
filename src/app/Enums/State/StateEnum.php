<?php

namespace App\Enums\State;

enum StateEnum: string
{
    case UNRESOLVED = '未対応';
    case IN_PROGRESS = '処理中';
    case COMPLETED = '処理済み';
    case FINISHED = '完了';

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
