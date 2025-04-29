<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
}
