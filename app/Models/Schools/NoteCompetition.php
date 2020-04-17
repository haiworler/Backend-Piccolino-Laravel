<?php

namespace App\Models\Schools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Schools\{Note};
use App\Models\MasterTables\{Cut};

class NoteCompetition extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'note',
        'observations',
        'note_id',
        'competencie_name',
        'enabled'
    ];

    public function note()
    {
        return $this->belongsTo(Note::class);
    }
}
