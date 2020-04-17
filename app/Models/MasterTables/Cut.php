<?php

namespace App\Models\MasterTables;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Schools\{Semester,Note,Group};

class Cut extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'enabled',
    ];

    public function semesters(){
        return $this->belongsToMany(Semester::class)->withTimestamps();
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
