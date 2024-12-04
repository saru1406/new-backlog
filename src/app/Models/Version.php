<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Version extends Model
{
    use HasFactory;

    /**
     * プロジェクトと紐づけ
     *
     * @return BelongsTo
     */
    public function projects(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * タスクと紐づけ
     *
     * @return HasMany
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     * 子タスクと紐づけ
     *
     * @return HasMany
     */
    public function childTasks(): HasMany
    {
        return $this->hasMany(ChildTask::class);
    }
}
