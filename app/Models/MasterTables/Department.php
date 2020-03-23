<?php

namespace App\Models\MasterTables;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
            'name',
            'country_id',
            'enabled'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function towns() 
    {
        return $this->hasMany(Town::class);
    }
}
