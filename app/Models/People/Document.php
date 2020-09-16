<?php

namespace App\Models\People;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\People\{People,CategoryDocument};


class Document extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'institution_name',
        'name',
        'expedition_date',
        'people_id',
        'category_document_id',
        'route',
        'observations',
        'enabled'
    ];
    public function people()
    {
        return $this->belongsTo(People::class);
    }

    public function categoryDocument()
    {
        return $this->belongsTo(CategoryDocument::class);
    }
    
}
