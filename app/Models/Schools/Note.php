<?php

namespace App\Models\Schools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Schools\{Group,Subject,Enrolled,Semester};
use App\Models\MasterTables\{Cut};

class Note extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'note',
        'observations',
        'subject_id',
        'group_id',
        'enrolled_id',
        'semester_id',
        'cut_id',
        'enabled'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function enrolled()
    {
        return $this->belongsTo(Enrolled::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function cut()
    {
        return $this->belongsTo(Cut::class);
    }
}
