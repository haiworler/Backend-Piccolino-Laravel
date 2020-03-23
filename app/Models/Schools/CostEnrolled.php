<?php

namespace App\Models\Schools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Schools\{Enrolled};

class CostEnrolled extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'value',
        'start_date',
        'end_date',
        'enabled'
    ];

    public function enrolleds()
    {
        return $this->hasMany(Enrolled::class);
    }
}
