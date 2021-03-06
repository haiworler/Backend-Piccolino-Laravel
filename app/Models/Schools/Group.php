<?php

namespace App\Models\Schools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Schools\{Headquarter,Semester,Enrolled,Subject,Assistance,ScheduleDay,Note};
use App\Models\People\{People};
use App\Models\MasterTables\{Cut};
class Group extends Model
{
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'headquarter_id',
        'semester_id',
        'people_id',
        'enabled'
    ];

    public function people()
    {
        return $this->belongsTo(People::class);
    }

    public function headquarter()
    {
        return $this->belongsTo(Headquarter::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function enrolleds(){
        return $this->belongsToMany(Enrolled::class)->withTimestamps();
    }

    public function subjects(){
        return $this->belongsToMany(Subject::class)->withTimestamps();
    }

    public function assistances()
    {
        return $this->hasMany(Assistance::class);
    }

    public function scheduleDays()
    {
        return $this->hasMany(ScheduleDay::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
