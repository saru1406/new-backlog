<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'project_id',
        'type_id',
        'state_id',
        'manager',
        'priority_id',
        'version_id',
        'title',
        'body',
        'start_date',
        'end_date',
    ];
}
