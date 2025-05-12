<?php

namespace App\Models;

use App\Helpers\Helper;
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
        return $this->belongsTo(Beneficiary::class,'beneficiary_id','id');
    }
    public function gatewayItem()
    {
        return $this->belongsTo(Gateway::class,'gateway_id','id');
    }
    public function scopeSandbox($query) {
        return $query->where("type",Helper::TYPESANDBOX);
    }
    public function scopeSecure($query) {
        return $query->where("type",Helper::TYPESECURE);
    }
    public function getStringStatusAttribute() {
        $status = $this->status;
        $data = [
            'class' => "",
            'value' => "",
        ];
        if($status == Helper::STATUSSUCCESS) {
            $data = [
                'class'     => "badge rounded-pill bg-success",
                'value'     => "success",
            ];
        }else if($status == Helper::STATUSPENDING) {
            $data = [
                'class'     => "badge rounded-pill bg-warning",
                'value'     => "Pending",
            ];
        }else if($status == Helper::STATUSHOLD) {
            $data = [
                'class'     => "badge rounded-pill bg-danger",
                'value'     => "Hold",
            ];
        }else if($status == Helper::STATUSREJECTED) {
            $data = [
                'class'     => "badge rounded-pill bg-danger",
                'value'     => "Rejected",
            ];
        }else if($status == Helper::STATUSWAITING) {
            $data = [
                'class'     => "badge rounded-pill bg-warning",
                'value'     => "Waiting",
            ];
        }else if($status == Helper::STATUSFAILD) {
            $data = [
                'class'     => "badge rounded-pill bg-danger",
                'value'     => "Failed",
            ];
        }else if($status == Helper::STATUSPROCESSING) {
            $data = [
                'class'     => "badge rounded-pill bg-warning",
                'value'     => "Processing",
            ];
        }

        return (object) $data;
    }
}
