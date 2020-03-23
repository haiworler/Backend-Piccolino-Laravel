<?php

namespace App\Models\MasterTables;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Schools\{Enrolled};

class Grade extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'code',
        'enabled',
    ];

    public function enrolleds()
    {
        return $this->hasMany(Enrolled::class);
    }
}
