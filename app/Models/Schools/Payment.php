<?php

namespace App\Models\Schools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\People\{People};
use App\Models\Schools\{Enrolled,Headquarter};
class Payment extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'value',
        'enrolled_id',
        'headquarter_id',
        'people_id',
        'observations',
        'enabled'
    ];

    public function enrolled()
    {
        return $this->belongsTo(Enrolled::class);
    }

    public function headquarter()
    {
        return $this->belongsTo(Headquarter::class);
    }

    public function people()
    {
        return $this->belongsTo(People::class);
    }
}
