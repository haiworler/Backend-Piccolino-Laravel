<?php

namespace App\Models\Security;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Models\Security\{Module};


class Profile extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'observations',
        'enabled',
        
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function modules(){
        return $this->belongsToMany(Module::class)->withTimestamps();
    }
}
