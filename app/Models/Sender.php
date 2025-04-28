<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sender extends Model
{
  protected $fillable=[
      'first_name',
      'last_name',
      'email',
      'date_birth',
      'num_document',
      'country',
      'phone',
      'identification_document',
      'occupation',
      'civility',
      'gender',
      'expired_document',
      'code',
      'address',
      'city',
'customer_id'       ];

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    public function currency(){
        $country=Country::query()->firstWhere(['codeIso2'=>$this->country]);
        return $country->currency;
    }
}
