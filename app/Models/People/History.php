<?php

namespace App\Models\People;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\People\{People,HistoryType};
use App\Models\MasterTables\{TypePeople};
use App\Models\Schools\{Semester,Subject};

class History extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'people_id',
        'history_type_id',
        'process',
        'hours',
        'start_date',
        'end_date',
        'description',
        'type_people_id',
        'subject_id',
        'semester_id',
        'enabled'
    ];

    public function people()
    {
        return $this->belongsTo(People::class);
    }

    public function historyType()
    {
        return $this->belongsTo(HistoryType::class);
    }
    public function typePeople()
    {
        return $this->belongsTo(TypePeople::class);
    }
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
