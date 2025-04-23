<?php


namespace App\Http\Controllers\Sandbox;


use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Sender;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class StaticController extends Controller
{
    public function dashboard(Request $request)
    {
        return view('sandbox.dashbord', [

        ]);
    }
    public function profil(Request $request)
    {
        $response = $this->api->get('wtc_profile_partners');
        $profile=[];
        logger($response);
        if ($response->successful()) {
            $data = $response->json();
            $profile = $data['data'];
        }
        return view('sandbox.profil', [
            'profile'=>$profile
        ]);
    }
    public function transferList(Request $request)
    {
        $auth=Auth::user();
        $customer=Customer::query()->firstWhere(['user_id'=>$auth->id]);
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $items = Transaction::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $items = new Transaction();
        }
        $items = $items->where(['customer_id'=>$customer->id])->orderByDesc('created_at')->paginate(20)->appends($query_param);

        return view('sandbox.transferList', [
            'transactions'=>$items
        ]);
    }
    public function make_mobil(Request $request)
    {

        return view('sandbox.make_mobil', [

        ]);
    }
    public function make_bank(Request $request)
    {
        $senders=[];
        $wallet=[];
        $countries=[];
        $originFonds=[];
        $relactions=[];
        $raisonTosend=[];

        $base=config('app.API_DOMAINCONFIG');

        $responseOriginFond = Http::get($base.'wace_origin_fond.json');
        $responseRelation= Http::get($base.'wace_relaction.json');
        $responseRaisonSend = Http::get($base.'wace_raison_to_send.json');


        if ($responseOriginFond->successful()) {
            $originFonds=$responseOriginFond->json()['data'];
        }
        if ($responseRaisonSend->successful()) {
            $raisonTosend=$responseRaisonSend->json()['data'];
        }
        if ($responseRelation->successful()) {
            $relactions=$responseRelation->json()['data'];
        }
        if ($request->method()=='POST'){
            $request->validate([
                'countryCode' => 'required',
                'gateway' => 'required',
                'operator' => 'required',
                'numSender' => 'required',
                'numBeneficiary' => 'required',
                'numCity' => 'required',
                'amount' => 'required',
                'raison_transaction' => 'required',
                'origin_fond' => 'required',
                'relation' => 'required',
                'accountNumber' => 'required',
            ],[
                'amount' => 'Password must contain 4 characters',
                'password.max' => 'Password must contain 14 characters',
            ]);
            $body=[
                'countryCode'=>$request->get('countryCode'),
                'gateway'=>$request->get('gateway'),
                'operator'=>$request->get('operator'),
                'numSender'=>$request->get('numSender'),
                'numBeneficiary'=>$request->get('numBeneficiary'),
                'numCity'=>$request->get('numCity'),
                'amount'=>$request->get('amount'),
                'raison_transaction'=>$request->get('raison_transaction'),
                'origin_fond'=>$request->get('origin_fond'),
                'iban'=>$request->get('iban'),
                'relation'=>$request->get('relation'),
                'accountNumber'=>$request->get('accountNumber'),
            ];


        }
        return view('sandbox.make_bank', [
            'countries'=>$countries,
            'relactions'=>$relactions,
            'wallets'=>$wallet,
            'originFonds'=>$originFonds,
            'senders'=>$senders,
            'raisons'=>$raisonTosend,
        ]);
    }

    public function senders(Request $request)
    {
        $auth=Auth::user();
        $customer=Customer::query()->firstWhere(['user_id'=>$auth->id]);
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $items = Sender::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $items = new Sender();
        }
        $items = $items->where(['customer_id'=>$customer->id])->orderByDesc('created_at')->paginate(20)->appends($query_param);

        return view('sandbox.senders', [
            'senders'=>$items
        ]);
    }
    public function addSender(Request $request)
    {
        $countries=Country::all();
        if ($request->method()=='POST'){
            $body=[
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
                'date_birth'=>$request->date_birth,
                'num_document'=>$request->num_document,
                'country'=>$request->country,
                'phone'=>$request->phone,
                'identification_document'=>$request->identification_document,
                'occupation'=>$request->occupation,
                'civility'=>$request->civility,
                'gender'=>$request->gender,
                'expired_document'=>$request->expired_document,

            ];
           $sender= new Sender();
           $sender->save($body);
                notify()->success('Data has been saved successfully!');
                return redirect()->route('sandbox.senders');

        }
        return view('sandbox.addSender', [
            'countries'=>$countries
        ]);
    }
    public function beneficiaries(Request $request)
    {
        $auth=Auth::user();
        $customer=Customer::query()->firstWhere(['user_id'=>$auth->id]);
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $items = Beneficiary::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $items = new Beneficiary();
        }
        $items = $items->where(['customer_id'=>$customer->id])->orderByDesc('created_at')->paginate(20)->appends($query_param);

        return view('sandbox.beneficiaries', [
            'numSender'=>$request->get('code'),
            'beneficiaries'=>$items
        ]);
    }
    public function addBeneficiaries(Request $request)
    {
        if ($request->method()=='POST'){
            $body=[
                'numSender'=>$request->get('numSender'),
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
                'dob'=>$request->date_birth,
                'num_document'=>$request->num_document,
                'country'=>$request->country,
                'phone'=>$request->phone,
                'identification_document'=>$request->identification_document,
                'zipcode'=>$request->zipcode,
                'civility'=>$request->civility,
                'gender'=>$request->gender,
                'expired_document'=>$request->expired_document,

            ];
            $resp =$this->api->post('beneficiaries',$body);
            logger($resp);
            if ($resp->successful()) {
                notify()->success('Data has been saved successfully!');
                return redirect()->route('sandbox.beneficiaries');
            }
            notify()->error('An error has occurred please try again later.');
        }
        return view('sandbox.addBeneficiary', [
            'countries'=>Country::all(),
        ]);
    }
    public function getBeneficiaryAjax(Request $request)
    {
        $beneficiaries=[];
        $response =$this->api->get('beneficiaries',[
            'numSender'=>$request->get('numSender')
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $beneficiaries=$data['data'];
        }
        return response()->json(['data' => $beneficiaries, 'status' => true]);
    }
    public function getCitiesAjax(Request $request)
    {
        $cities=[];
        $response =$this->api->get('cities',[
            'numCountry'=>$request->get('numCountry')
        ]);
        logger($response);
        if ($response->successful()) {
            $data = $response->json();
            $cities=$data['data'];
        }
        return response()->json(['data' => $cities, 'status' => true]);
    }

    public function getOperatorsAjax(Request $request)
    {
        $cities=[];
        $response =$this->api->get('operators',[
            'gateway'=>$request->get('gateway'),
            'country'=>$request->get('numCountry')

        ]);
        logger($response);
        if ($response->successful()) {
            $data = $response->json();
            $cities=$data['data'];
        }
        return response()->json(['data' => $cities, 'status' => true]);
    }
}
