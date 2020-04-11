<?php

namespace App\Models\Schools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Schools\{Group,Assistance,Schedule,Note,Competencie};
use App\Models\People\{People};

class Subject extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'code',
        'observations',
        'credits',
        'enabled'
    ];

    public function groups(){
        return $this->belongsToMany(Group::class)->withTimestamps();
    }
    
    public function people(){
        return $this->belongsToMany(People::class)->withTimestamps();
    }

    public function assistances()
    {
        return $this->hasMany(Assistance::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function competencies()
    {
        return $this->hasMany(Competencie::class);
    }
}
