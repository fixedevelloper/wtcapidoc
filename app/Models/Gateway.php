<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }
}
