<?php

namespace App\Models\MasterTables;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\People\{People};

class Town extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'department_id',
        'enabled',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function localities()
    {
        return $this->hasMany(Locality::class);
    }
    
    public function people()
    {
        return $this->hasMany(People::class);
    }
}
