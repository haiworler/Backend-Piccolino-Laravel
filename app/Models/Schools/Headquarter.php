<?php

namespace App\Models\Schools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\MasterTables\{Neighborhood};
use App\Models\Schools\{Enrolled,Group,Payment,ScheduleHour};

class Headquarter extends Model
{
    

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'neighborhood_id',
        'observations',
        'enabled'
    ];


    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }

    public function enrolleds()
    {
        return $this->hasMany(Enrolled::class);
    }
    
    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function scheduleHours()
    {
        return $this->hasMany(ScheduleHour::class);
    }
}
