<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BrgyOfficials extends Model
{

    protected $appends = ['computed_age'];
    protected $table = 'brgy_officials';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'email',
        'phone_number',
        'age',
        'birthdate',
        'birthplace',
        'gender',
        'civil_status',
        'photo',
        'purok_id',
        'term_start',
        'term_end',
        'position_id',
        'committee_id',
    ];

    public function getComputedAgeAttribute()
    {
        return $this->birthdate
            ? Carbon::parse($this->birthdate)->age
            : null;
    }

    public function scopeActive($query)
    {
        return $query->whereDate('term_start', '<=', now())
            ->whereDate('term_end', '>=', now());
    }

    public function purok()
    {
        return $this->belongsTo(Purok::class);
    }

    public function position()
    {
        return $this->belongsTo(BrgyOfficialPosition::class, 'position_id');
    }

    public function committee()
    {
        return $this->belongsTo(BrgyCommitteePosition::class);
    }
}