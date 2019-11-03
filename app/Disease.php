<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    public function Symptoms()
    {
        return $this->belongsToMany(Symptom::class,'diseases_symptoms');
    }
}
