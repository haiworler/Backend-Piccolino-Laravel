<?php

namespace App\Models\People;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\MasterTables\{TypeDocument, Town, Gender, Neighborhood, Occupation, TypePeople};
use App\User;
use App\Models\Schools\{Enrolled,Group,Subject,Assistance,Payment,ScheduleHour};

class People extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'names',
        'surnames',
        'type_document_id',
        'document_number',
        'birth_date',
        'birth_town_id',
        'gender_id',
        'phone',
        'cell',
        'email',
        'address_residence',
        'neighborhood_id',
        'occupation_id',
        'rh',
        'eps',
        'observations',
        'stratum',
        'level_sisben',
        'type_people_id',
        'history',
        'enabled',
    ];

    public function typeDocument()
    {
        return $this->belongsTo(TypeDocument::class);
    }

    public function town()
    {
        return $this->belongsTo(Town::class,'birth_town_id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }

    public function occupation()
    {
        return $this->belongsTo(Occupation::class);
    }

    public function typePeople()
    {
        return $this->belongsTo(TypePeople::class);
    }

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    
    public function enrolleds()
    {
        return $this->hasMany(Enrolled::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function subjects(){
        return $this->belongsToMany(Subject::class)->withTimestamps();
    }

    public function assistances()
    {
        return $this->hasMany(Assistance::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function scheduleHours()
    {
        return $this->hasMany(ScheduleHour::class);
    }
}
