<?php

namespace App\Models\Security;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Security\{Profile};

class Module extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'route',
        'icon',
        'class',
        'module_id',
        'abstract',
        'enabled',
    ];

    public function profiles(){
        return $this->belongsToMany(Profile::class)->withTimestamps();
    }

    public function module(){
        return $this->hasMany(Module::class,'module_id');
    }

    public function children(){
        return $this->hasMany(Module::class,'module_id')->with('children');
    }
}
