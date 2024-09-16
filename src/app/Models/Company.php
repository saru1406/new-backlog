<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'company_name',
        'domain',
    ];

    /**
     * ユーザーと紐づけ
     *
     * @return HasMany
     */
    public function Users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * プロジェクトと紐づけ
     *
     * @return HasMany
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
