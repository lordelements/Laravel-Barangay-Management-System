<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Resident extends Model
{

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
        'street',
        'gender',
        'civil_status',
        'voter_status',
        'description',
        'photo',
        'purok_id',
    ];

    protected static function booted()
    {
        static::saving(function ($resident) {
            if ($resident->birthdate) {
                $resident->age = Carbon::parse($resident->birthdate)->age;
            }
        });
    }

    public function purok()
    {
        return $this->belongsTo(Purok::class);
    }
    
    protected function AuditTrail()
    {
        return $this->hasMany(AuditTrail::class);
    }
}