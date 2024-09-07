<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Target extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'users_id',
        'contents',
        'type'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'targets_id', 'targets_id');
    }

    public function types()
    {
        return $this->hasOne(TargetsType::class, 'targets_id', 'targets_id');
    }
}
