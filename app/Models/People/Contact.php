<?php

namespace App\Models\People;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\People\{People,ContactType};

class Contact extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'people_id',
        'contact_type_id',
        'names',
        'surnames',
        'phone',
        'cell',
        'description',
        'enabled'
    ];

    public function people()
    {
        return $this->belongsTo(People::class);
    }

    public function contactType()
    {
        return $this->belongsTo(ContactType::class);
    }
}
