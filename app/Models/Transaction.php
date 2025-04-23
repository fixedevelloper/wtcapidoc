<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    public function sender()
    {
        return $this->belongsTo(Sender::class,'sender_id','id');
    }
    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class,'customer_id','id');
    }
    public function gateway()
    {
        return $this->belongsTo(Gateway::class,'gateway_id','id');
    }
}
