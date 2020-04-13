<?php

namespace App\Models\Schools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Schools\{ScheduleDay};

class Day extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'enabled'
    ];

     public function scheduleDays()
     {
         return $this->hasMany(ScheduleDay::class);
     }
}
