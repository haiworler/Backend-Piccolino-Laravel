<?php

namespace App\Models\People;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class History extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'people_id',
        'historie_type_id',
        'process',
        'hours',
        'start_date',
        'end_date',
        'description',
        'position',
        'enabled'
    ];
}
