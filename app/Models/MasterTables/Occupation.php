<?php

namespace App\Models\MasterTables;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\People\{People};
use App\Models\MasterTables\{Position};

class Occupation extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'position_id',
        'name',
        'enabled',
    ];

    public function people()
    {
        return $this->hasMany(People::class);
    }
    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
