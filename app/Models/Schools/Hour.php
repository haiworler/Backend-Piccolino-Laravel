<?php

namespace App\Models\Schools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Schools\{ScheduleHour};

class Hour extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'enabled'
    ];

     public function scheduleHours()
     {
         return $this->hasMany(ScheduleHour::class);
     }
}
