<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrgyCommitteePosition extends Model
{
    protected $table = 'committee_position';
    protected $fillable = ['committee_name'];
    
    public function brgyOfficial()
    {
        return $this->hasMany(BrgyOfficials::class);
    }
}