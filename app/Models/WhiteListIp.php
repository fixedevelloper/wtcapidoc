<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhiteListIp extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
}
