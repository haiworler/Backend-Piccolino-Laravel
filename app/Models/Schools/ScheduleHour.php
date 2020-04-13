<?php

namespace App\Models\Schools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Schools\{Subject, Hour, ScheduleDay,Headquarter};
use App\Models\People\{People};

class ScheduleHour extends Model
{
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];

    protected $fillable = [
        'hour_id',
        'people_id',
        'subject_id',
        'schedule_day_id',
        'headquarter_id',
        'enabled'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function hour()
    {
        return $this->belongsTo(Hour::class);
    }
    public function scheduleDay()
    {
        return $this->belongsTo(ScheduleDay::class);
    }
    public function headquarter()
    {
        return $this->belongsTo(Headquarter::class);
    }
    public function people()
    {
        return $this->belongsTo(People::class);
    }
}
