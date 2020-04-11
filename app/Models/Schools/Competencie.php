<?php

namespace App\Models\Schools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Schools\{Subject};


class Competencie extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'subject_id',
        'enabled'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
