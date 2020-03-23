<?php

namespace App\Models\Schools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\People\{People};
use App\Models\Schools\{Group,Subject};
class Schedule extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'group_id',
        'subject_id',
        'people_id',
        'date',
        'start_time',
        'end_time',
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

    public function people()
    {
        return $this->belongsTo(People::class);
    }
}
