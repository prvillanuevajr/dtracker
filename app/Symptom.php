<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    public function diseases()
    {
        return $this->belongsToMany(Disease::class,'diseases_symptoms');
    }
}
