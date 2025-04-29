<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;

class DepositRequest extends Model
{

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
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
                'class'     => "badge rounded-pill bg-warning",
                'value'     => "Hold",
            ];
        }else if($status == Helper::STATUSREJECTED) {
            $data = [
                'class'     => "badge rounded-pill bg-danger",
                'value'     => "Rejected",
            ];
        }else if($status == Helper::STATUSWAITING) {
            $data = [
                'class'     => "badge rounded-pill bg-danger",
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
