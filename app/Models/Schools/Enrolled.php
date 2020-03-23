<?php

namespace App\Models\Schools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\MasterTables\{Grade};
use App\Models\People\{People};
use App\Models\Schools\{Headquarter,CostEnrolled,Semester,Group,Assistance,Payment,Note};

class Enrolled extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'people_id',
        'code',
        'headquarter_id',
        'cost_enrolled_id',
        'semester_id',
        'observations',
        'grade_id',
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

    public function costEnrolled()
    {
        return $this->belongsTo(CostEnrolled::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function groups(){
        return $this->belongsToMany(Group::class)->withTimestamps();
    }

    public function assistances()
    {
        return $this->hasMany(Assistance::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
