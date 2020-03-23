<?php

namespace App\Models\MasterTables;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\People\{People};

class TypePeople extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'enabled',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function people()
    {
        return $this->hasMany(People::class);
    }
}
