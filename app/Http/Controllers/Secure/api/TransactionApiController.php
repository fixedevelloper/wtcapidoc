<?php


namespace App\Http\Controllers\Sandbox\api;


use App\Helpers\api\Helpers;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\City;
use App\Models\Country;
use App\Models\Gateway;
use App\Models\Rate;
use App\Models\Sender;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionApiController extends Controller
{

    public function getTransaction(Request $request)
    {
        $customer = $request->customer;
        if (!isset($request->number_transaction)) {
            return Helpers::error('number_transaction is missing');
        }
        $transaction = Transaction::query()->firstWhere(['number_transaction' => $request->number_transaction, 'type' => Helper::TYPESECURE,
            'customer_id' => $customer->id]);

        if (is_null($transaction)) {
            return Helpers::error('transaction not found');
        }
        $message = 'transaction successful';
        return Helpers::success([
            'number_transaction' => $transaction->number_transaction,
            'status' => $transaction->stringStatus->value,
            'relation' => $transaction->relation,
            'origin_fond' => $transaction->origin_fond,
            'motif_send' => $transaction->motif_send,
            'amount_send' => $transaction->amount_total,
            'country' => $transaction->gatewayItem->country->name,
            'currency' => $transaction->gatewayItem->country->currency,
            'amount_debit' => $transaction->amount + $transaction->rate,
            'bank' => $transaction->gatewayItem->name,
            'accountNumber' => $transaction->accountNumber,
            'sender' => [
                'first_name' => $transaction->sender->first_name,
                'last_name' => $transaction->sender->last_name,
                'email' => $transaction->sender->email,
                'phone' => $transaction->sender->phone,
                'code' => $transaction->sender->code,
                'occupation' => $transaction->sender->occupation,
                'civility' => $transaction->sender->civility,
                'gender' => $transaction->sender->gender,
                'document_type' => $transaction->sender->identification_document,
                'document_expired' => $transaction->sender->expired_document,
                'document_number' => $transaction->sender->num_document
            ],
            'beneficiary' => [
                'first_name' => $transaction->beneficiary->first_name,
                'last_name' => $transaction->beneficiary->last_name,
                'email' => $transaction->beneficiary->email,
                'phone' => $transaction->beneficiary->phone,
                'code' => $transaction->beneficiary->code,
                'occupation' => $transaction->beneficiary->occupation,
                'civility' => $transaction->beneficiary->civility,
                'gender' => $transaction->beneficiary->gender,
                'document_type' => $transaction->beneficiary->identification_document,
                'document_expired' => $transaction->beneficiary->expired_document,
                'document_number' => $transaction->beneficiary->num_document
            ],

        ], $message);
    }

    public function postBankTransaction(Request $request)
    {
        $customer = $request->customer;


        $validator = Validator::make($request->all(), [
            'country_code' => 'required',
            'gateway' => 'required',
            'bank' => 'required',
            'sender_code' => 'required',
            'beneficiary_code' => 'required',
            'city' => 'required',
            'amount' => 'required',
            'raison_transaction' => 'required',
            'origin_fond' => 'required',
            'relation' => 'required',
            'accountNumber' => 'required',
        ]);

        if ($validator->fails()) {
            $err = null;
            foreach ($validator->errors()->all() as $error) {
                $err = $error;
            }
            return Helpers::error($err);
        }
        $country=Country::query()->firstWhere(['codeIso2'=>$request->country_code]);
        if (is_null($country)){
            return Helpers::error('country not found');
        }
        $gateway=Gateway::query()->firstWhere(['name'=>$request->bank,'country_id'=>$country->id]);
        if (is_null($gateway)){
            return Helpers::error('bank not exist in country');
        }
        $sender=Sender::query()->firstWhere(['code'=>$request->sender_code,'customer_id'=>$customer->id]);
        if (is_null($sender)){
            return Helpers::error('sender not found');
        }
        $beneficiary=Beneficiary::query()->firstWhere(['code'=>$request->beneficiary_code,'customer_id'=>$customer->id]);
        if (is_null($beneficiary)){
            return Helpers::error('beneficiary not found');
        }
        $city=City::query()->firstWhere(['name'=>$request->city,'country_id'=>$country->id]);
        if (is_null($city)){
            return Helpers::error('city not found');
        }
        $rate=$this->calculRate($country->id,$customer->id,$request->amount);
       if ($rate['status']==0){
           return Helpers::unauthorized('unauthorized for this country');
       }
        $amount_total=$rate['total'];
        if ($customer->balance_sandbox<$rate['total_local']){
          return Helpers::error('Balance Insufficient');
        }
        DB::beginTransaction();
        $transaction=new Transaction();
        $transaction->sender_id=$sender->id;
        $transaction->relation=$request->get('relation');
        $transaction->origin_fond=$request->get('origin_fond');
        $transaction->motif_send=$request->get('raison_transaction');
        $transaction->accountNumber=$request->get('accountNumber');
        $transaction->wallet=$request->get('wallet');
        $transaction->iban=$request->get('iban');
        $transaction->beneficiary_id=$beneficiary->id;
        $transaction->gateway_id=$gateway->id;
        $transaction->city=$city->id;
        $transaction->amount=$request->get('amount');
        $transaction->code=Helper::generatenumber();
        $transaction->number_transaction='wtc_'.Helper::generateTransactionNumber(20);
        $transaction->amount_total=$amount_total;
        $transaction->rate=$rate['costs'];
        $transaction->customer_id=$customer->id;
        $transaction->type=Helper::TYPESECURE;
        $transaction->method=Helper::METHODBANK;
        $transaction->status=Helper::STATUSPENDING;
       $transaction->save();
        $customer->balance_sandbox-=$rate['total_local'];
       $customer->save();
        DB::commit();
        return Helpers::success([], 'transaction created successful');
    }
    function calculRate($country_id,$customer_id,$amount){

        $rate_country=Rate::query()->firstWhere(['customer_id'=>$customer_id,'country_id'=>$country_id]);
        if (is_null($rate_country)){
            return [
                'status'=>0
            ];
        }

        $costs=$amount*($rate_country->cost*0.01);
        $value=$amount+floatval($rate_country->fixed_amount)+$costs;
        return[
            'status'=>1,
            'total'=>$amount*$rate_country->rate,
            'costs'=>$costs+$rate_country->fixed_amount,
            'total_local'=>$value,
            'rate'=>$rate_country->rate
        ];
    }
}
