<?php

namespace App\Models\People;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


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
        'grade_id',
        'observations',
        'enabled'
    ];
}
