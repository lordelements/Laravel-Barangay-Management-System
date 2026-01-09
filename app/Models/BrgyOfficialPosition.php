<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrgyOfficialPosition extends Model
{
    protected $table = 'positions';
    protected $fillable = ['position', 'max_active'];
    
    public function brgyOfficials()
    {
        return $this->hasMany(BrgyOfficials::class, 'position_id');
    }
}