<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    protected $guarded = [];

    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
