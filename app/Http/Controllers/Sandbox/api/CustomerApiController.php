<?php


namespace App\Http\Controllers\Sandbox\api;


use App\Helpers\api\Helpers;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\City;
use App\Models\Country;
use App\Models\Gateway;
use App\Models\Sender;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CustomerApiController extends Controller
{
    public function getSenders(Request $request)
    {
        $customer = $request->customer;
        $senders=[];
        $senders_ = Sender::query()->where(['customer_id' => $customer->id])->get();
        foreach ($senders_ as $item){
            $senders[]=[
                'first_name' => $item->first_name,
                'last_name' => $item->last_name,
                'email' => $item->email,
                'phone' => $item->phone,
                'code' => $item->code,
                'occupation' => $item->occupation,
                'civility' => $item->civility,
                'gender' => $item->gender,
                'document_type' => $item->identification_document,
                'document_expired' => $item->expired_document,
                'document_number' => $item->num_document

            ];
        }
        $message = 'senders get successful';
        return Helpers::success($senders, $message);
    }
    public function getSender(Request $request)
    {
        $customer = $request->customer;
        if (!isset($request->code)) {
            return Helpers::error('code is missing');
        }
        $sender = Sender::query()->firstWhere(['code' => $request->code,
            'customer_id' => $customer->id]);

        if (is_null($sender)) {
            return Helpers::error('sender not found');
        }
        $message = 'sender get successful';
        return Helpers::success([
            'first_name' => $sender->first_name,
            'last_name' => $sender->last_name,
            'email' => $sender->email,
            'phone' => $sender->phone,
            'code' => $sender->code,
            'occupation' => $sender->occupation,
            'civility' => $sender->civility,
            'gender' => $sender->gender,
            'document_type' => $sender->identification_document,
            'document_expired' => $sender->expired_document,
            'document_number' => $sender->num_document

        ], $message);
    }
    public function getBeneficiaries(Request $request)
    {
        $customer = $request->customer;
        $senders=[];
        $senders_ = Beneficiary::query()->where(['customer_id' => $customer->id])->get();
        foreach ($senders_ as $item){
            $senders[]=[
                'first_name' => $item->first_name,
                'last_name' => $item->last_name,
                'email' => $item->email,
                'phone' => $item->phone,
                'code' => $item->code,
                'occupation' => $item->occupation,
                'civility' => $item->civility,
                'gender' => $item->gender,
                'document_type' => $item->identification_document,
                'document_expired' => $item->expired_document,
                'document_number' => $item->num_document

            ];
        }
        $message = 'senders get successful';
        return Helpers::success($senders, $message);
    }
    public function getBeneficiary(Request $request)
    {
        $customer = $request->customer;
        if (!isset($request->code)) {
            return Helpers::error('code is missing');
        }
        $sender = Beneficiary::query()->firstWhere(['code' => $request->code,
            'customer_id' => $customer->id]);

        if (is_null($sender)) {
            return Helpers::error('sender not found');
        }
        $message = 'sender get successful';
        return Helpers::success([
            'first_name' => $sender->first_name,
            'last_name' => $sender->last_name,
            'email' => $sender->email,
            'phone' => $sender->phone,
            'code' => $sender->code,
            'occupation' => $sender->occupation,
            'civility' => $sender->civility,
            'gender' => $sender->gender,
            'document_type' => $sender->identification_document,
            'document_expired' => $sender->expired_document,
            'document_number' => $sender->num_document

        ], $message);
    }
    public function getCities(Request $request)
    {
        $customer = $request->customer;
        if (!isset($request->codeiso2)) {
            return Helpers::error('code is missing');
        }
        $country=Country::query()->firstWhere(['codeIso2'=>$request->codeiso2]);
        if (is_null($country)) {
            return Helpers::error('country is missing');
        }
        $countries_=[];
        $countries = City::query()->where(['country_id'=>$country->id])->get();

        foreach ($countries as $item){
            $countries_[]=[
                'name' => $item->name,
                'country' => $country->name,

            ];
        }
        $message = 'cities get successful';
        return Helpers::success($countries_, $message);
    }
    public function getCountries(Request $request)
    {
        $customer = $request->customer;
        $countries_=[];
        $countries = Country::query()->where([])->get();

        foreach ($countries as $item){
            $countries_[]=[
                'name' => $item->name,
                'code_iso' => $item->codeIso2,
                'currency' => $item->currency

            ];
        }
        $message = 'senders get successful';
        return Helpers::success($countries_, $message);
    }

    public function getBanks(Request $request)
    {
        $customer = $request->customer;
        if (!isset($request->codeiso2)) {
            return Helpers::error('code is missing');
        }
        $country=Country::query()->firstWhere(['codeIso2'=>$request->codeiso2]);
        if (is_null($country)) {
            return Helpers::error('country is missing');
        }
        $countries_=[];
        $countries = Gateway::query()->where(['country_id'=>$country->id])->get();

        foreach ($countries as $item){
            $countries_[]=[
                'name' => $item->name,
                'country' => $country->name,

            ];
        }
        $message = 'banks get successful';
        return Helpers::success($countries_, $message);
    }
}
