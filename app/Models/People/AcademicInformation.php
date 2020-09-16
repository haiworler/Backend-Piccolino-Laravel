<?php

namespace App\Models\People;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\People\{People,TrainingType};

class AcademicInformation extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'people_id',
        'training_type_id',
        'institution_name',
        'date',
        'name',
        'observations',
        'route',
        'enabled'
    ];

    public function people()
    {
        return $this->belongsTo(People::class);
    }

    public function trainingType()
    {
        return $this->belongsTo(TrainingType::class);
    }
}
