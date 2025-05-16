<?php


namespace App\Http\Controllers\Secure\api;


use App\Helpers\api\Helpers;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\City;
use App\Models\Country;
use App\Models\Gateway;
use App\Models\Sender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomerApisecureController extends Controller
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
        $message = 'countries get successful';
        return Helpers::success($countries_, $message);
    }
    public function getNetworks(Request $request)
    {
        $customer = $request->customer;
        if (!isset($request->codeiso)) {
            return Helpers::error('code is missing');
        }
        $country = Country::query()->firstWhere(['codeIso2' => $request->codeiso]);
        if (is_null($country)) {
            return Helpers::error('country is missing');
        }
        $countries_ = [];
        $countries = Gateway::query()->where(['method' => $country->code_gateway_mobil, 'country_id' => $country->id])->get();
        foreach ($countries as $item) {
            $countries_[] = [
                'name' => $item->name,
                'country' => $country->name,
            ];
        }
        $message = 'networks get successful';
        return Helpers::success($countries_, $message);
    }
    public function getBanks(Request $request)
    {
        $customer = $request->customer;
        if (!isset($request->codeiso)) {
            return Helpers::error('code is missing');
        }
        $country = Country::query()->firstWhere(['codeIso2' => $request->codeiso]);
        if (is_null($country)) {
            return Helpers::error('country is missing');
        }
        $countries_ = [];
        $countries = Gateway::query()->where(['method' => $country->code_gateway_bank, 'country_id' => $country->id])->get();
        foreach ($countries as $item) {
            $countries_[] = [
                'name' => $item->name,
                'country' => $country->name,
            ];
        }
        $message = 'banks get successful';
        return Helpers::success($countries_, $message);
    }
    public function postSenders(Request $request)
    {
        $customer = $request->customer;

        $validator = Validator::make($request->all(), [
            'country_code' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'date_birth' => 'required',
            'num_document' => 'required',
            'type_document' => 'required',
            'occupation' => 'required',
            'civility' => 'required',
            'gender' => 'required',
            'expired_document' => 'required',
            'address' => 'required',
            'city' => 'required',
        ]);

        if ($validator->fails()) {
            $err = null;
            foreach ($validator->errors()->all() as $error) {
                $err = $error;
            }
            return Helpers::error($err);
        }
        $country = Country::query()->firstWhere(['codeIso2' => $request->country_code]);
        if (is_null($country)) {
            return Helpers::error('country not found');
        }
        $city = City::query()->firstWhere(['name' => $request->city, 'country_id' => $country->id]);
        if (is_null($city)) {
            return Helpers::error('city not found');
        }
        $sender_email = Sender::query()->firstWhere(['email' => $request->email]);
        if (!is_null($sender_email)) {
            return Helpers::error('Duplicate entry for sender :' . $request->email);
        }
        DB::beginTransaction();
        $body = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'date_birth' => $request->date_birth,
            'num_document' => $request->num_document,
            'country' => $request->country_code,
            'phone' => $request->phone,
            'identification_document' => $request->type_document,
            'occupation' => $request->occupation,
            'civility' => $request->civility,
            'gender' => $request->gender,
            'expired_document' => $request->expired_document,
            'code' => Helper::generatenumber(),
            'address' => $request->address,
            'city' => $request->city,
            'customer_id' => $customer->id

        ];
        try {
            $sender = new Sender($body);
            $sender->save($body);
        } catch (\Exception $exception) {
            return Helpers::error($exception->getMessage());
        }

        DB::commit();
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
        ], 'sender created successful');
    }

    public function postBeneficiaries(Request $request)
    {
        $customer = $request->customer;

        $validator = Validator::make($request->all(), [
            'country_code' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'date_birth' => 'required',
            'num_document' => 'required',
            'type_document' => 'required',
            'occupation' => 'required',
            'civility' => 'required',
            'gender' => 'required',
            'expired_document' => 'required',
            'address' => 'required',
            'city' => 'required',
        ]);

        if ($validator->fails()) {
            $err = null;
            foreach ($validator->errors()->all() as $error) {
                $err = $error;
            }
            return Helpers::error($err);
        }
        $country = Country::query()->firstWhere(['codeIso2' => $request->country_code]);
        if (is_null($country)) {
            return Helpers::error('country not found');
        }
        $city = City::query()->firstWhere(['name' => $request->city, 'country_id' => $country->id]);
        if (is_null($city)) {
            return Helpers::error('city not found');
        }
        $beneficiary = Beneficiary::query()->firstWhere(['email' => $request->email]);
        if (!is_null($beneficiary)) {
            return Helpers::error('email address is already used for a recipient');
        }
        DB::beginTransaction();
        $body = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'date_birth' => $request->date_birth,
            'num_document' => $request->num_document,
            'country' => $request->country_code,
            'phone' => $request->phone,
            'identification_document' => $request->type_document,
            'occupation' => $request->occupation,
            'civility' => $request->civility,
            'gender' => $request->gender,
            'expired_document' => $request->expired_document,
            'code' => Helper::generatenumber(),
            'address' => $request->address,
            'city' => $request->city,
            'customer_id' => $customer->id

        ];
        $item = new Beneficiary($body);
        $item->save($body);
        DB::commit();
        return Helpers::success([
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

        ], 'beneficiary created successful');
    }
}
