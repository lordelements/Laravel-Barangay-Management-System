<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function purok()
    {
        return $this->belongsTo(Purok::class);
    }
}