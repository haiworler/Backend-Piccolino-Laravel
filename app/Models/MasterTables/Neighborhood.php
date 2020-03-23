<?php

namespace App\Models\MasterTables;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;
use App\Models\People\{People};
use App\Models\Schools\{Headquarter};

class Neighborhood extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'locality_id',
        'enabled',
    ];

    public function locality()
    {
        return $this->belongsTo(Locality::class);
    }

    public function people()
    {
        return $this->hasMany(People::class);
    }

    public function headquarters()
    {
        return $this->hasMany(Headquarter::class);
    }
}
