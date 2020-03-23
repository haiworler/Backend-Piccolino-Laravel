<?php

namespace App\Models\Schools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Schools\{Enrolled,Group,Note};
use App\Models\MasterTables\{Cut};

class Semester extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'start_date',
        'end_date',
        'observations',
        'code',
        'enabled'
    ];

    public function enrolleds()
    {
        return $this->hasMany(Enrolled::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function cuts(){
        return $this->belongsToMany(Cut::class)->withTimestamps();
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
