<?php

namespace App\Models\Schools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Schools\{Group,Day,ScheduleHour};


class ScheduleDay extends Model
{
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'group_id',
        'day_id',
        'enabled'
    ];
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    public function scheduleHours()
    {
        return $this->hasMany(ScheduleHour::class);
    }
}
