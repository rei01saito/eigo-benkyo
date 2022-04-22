<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetsType extends Model
{
    use HasFactory;

    protected $fillable = [
        'targets_id',
        'title',
        'contents',
        'accomplished'
    ];

    protected $primaryKey = 'targets_types_id';
}
