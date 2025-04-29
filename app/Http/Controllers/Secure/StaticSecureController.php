<?php


namespace App\Http\Controllers\Secure;


use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use App\Models\DepositRequest;
use App\Models\Gateway;
use App\Models\Journal;
use App\Models\Rate;
use App\Models\Sender;
use App\Models\Transaction;
use App\Models\WithdrawRequest;
use App\Services\WaceApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class StaticSecureController extends Controller
{
    protected $waceService;

    /**
     * StaticSecureController constructor.
     * @param $waceService
     */
    public function __construct(WaceApiService $waceService)
    {
        $this->waceService = $waceService;
    }

    public function dashboard(Request $request)
    {
        return view('secure.dashbord', [

        ]);
    }

    public function profil(Request $request)
    {
        $profile=Customer::query()->firstWhere(['user_id'=>\auth()->user()->id]);
        logger($profile);
        return view('secure.profil', [
            'profile' => $profile
        ]);
    }

    public function transferList(Request $request)
    {
        $auth = Auth::user();
        $customer = Customer::query()->firstWhere(['user_id' => $auth->id]);
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $items = Transaction::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $items = new Transaction();
        }
        $items = $items->where(['customer_id' => $customer->id,'type'=>Helper::TYPESECURE])->orderByDesc('created_at')->paginate(20)->appends($query_param);

        return view('secure.transferList', [
            'transactions' => $items
        ]);
    }
    public function withdraws(Request $request)
    {
        $auth = Auth::user();
        $customer = Customer::query()->firstWhere(['user_id' => $auth->id]);
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $items = WithdrawRequest::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $items = new WithdrawRequest();
        }
        $items = $items->where(['customer_id' => $customer->id])->orderByDesc('created_at')->paginate(20)->appends($query_param);

        return view('secure.withdraws', [
            'withdraws' => $items
        ]);
    }
    public function deposits(Request $request)
    {
        $auth = Auth::user();
        $customer = Customer::query()->firstWhere(['user_id' => $auth->id]);
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $items = DepositRequest::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $items = new DepositRequest();
        }
        $items = $items->where(['customer_id' => $customer->id])->orderByDesc('created_at')->paginate(20)->appends($query_param);

        return view('secure.deposits', [
            'deposits' => $items
        ]);
    }
    public function journals(Request $request)
    {
        $auth = Auth::user();
        $customer = Customer::query()->firstWhere(['user_id' => $auth->id]);
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $items = Journal::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $items = new Journal();
        }
        $items = $items->where(['customer_id' => $customer->id])->orderByDesc('created_at')->paginate(20)->appends($query_param);

        return view('secure.journals', [
            'journals' => $items
        ]);
    }
    public function make_mobil(Request $request)
    {
        $auth = Auth::user();
        $customer = Customer::query()->firstWhere(['user_id' => $auth->id]);
        $senders = Sender::query()->where(['customer_id'=>$customer->id])->get();
        $beneficiaries = Beneficiary::query()->where(['customer_id'=>$customer->id])->get();
        $wallet = [];
        $countries = Country::all();
        $originFonds = [];
        $relactions = [];
        $raisonTosend = [];

        $base = config('app.API_DOMAINCONFIG');

        $responseOriginFond = Http::get($base . 'wace_origin_fond.json');
        $responseRelation = Http::get($base . 'wace_relaction.json');
        $responseRaisonSend = Http::get($base . 'wace_raison_to_send.json');

        $gateways = [
            'AGENSICPAY_XAF', 'AGENSICPAY_XOF'
        ];
        if ($responseOriginFond->successful()) {
            $originFonds = $responseOriginFond->json()['data'];
        }
        if ($responseRaisonSend->successful()) {
            $raisonTosend = $responseRaisonSend->json()['data'];
        }
        if ($responseRelation->successful()) {
            $relactions = $responseRelation->json()['data'];
        }
        if ($request->method() == 'POST') {
            $validator = Validator::make($request->all(), [
                'countryCode' => 'required',
                'wallet' => 'required',
                'gateway_id' => 'required',
                'numSender' => 'required',
                'numBeneficiary' => 'required',
                'numCity' => 'required',
                'amount' => 'required',
                'raison_transaction' => 'required',
                'origin_fond' => 'required',
                'relation' => 'required',
                'accountNumber' => 'required',
            ], [
                'amount' => 'Password must contain 4 characters',
                'password.max' => 'Password must contain 14 characters',
            ]);
            if ($validator->fails()) {
                // Utilisez notify pour afficher les erreurs
                foreach ($validator->errors()->all() as $error) {
                    notify()->error($error);
                }

                return redirect()->back()->withInput();
            }
            $amount=$request->get('amount');
            $rate=$this->calculRate($request->countryCode,$customer->id,$amount);
            if ($rate['status']==0){
                notify()->error('unauthorized for this country');
                return redirect()->back()->withInput();
            }
            $amount_total=$rate['total'];
            if ($customer->balance<$rate['total_local']){
                notify()->error('Balance Insufficient');
                return redirect()->back()->withInput();
            }
            DB::beginTransaction();
            $transaction=new Transaction();
            $transaction->sender_id=$request->get('numSender');
            $transaction->relation=$request->get('relation');
            $transaction->origin_fond=$request->get('origin_fond');
            $transaction->motif_send=$request->get('raison_transaction');
            $transaction->accountNumber=$request->get('accountNumber');
            $transaction->wallet=$request->get('wallet');
            $transaction->iban=$request->get('iban');
            $transaction->beneficiary_id=$request->get('beneficiary_id');
            $transaction->gateway_id=$request->get('gateway_id');
            $transaction->beneficiary_id=$request->get('numBeneficiary');
            $transaction->city=$request->get('numCity');
            $transaction->amount=$request->get('amount');
            $transaction->code=Helper::generatenumber();
            $transaction->number_transaction='wtc_'.Helper::generateTransactionNumber(20);
            $transaction->amount_total=$amount_total;
            $transaction->rate=$rate['costs'];
            $transaction->customer_id=$customer->id;
            $transaction->type=Helper::TYPESECURE;
            $transaction->method=Helper::METHODMOBIL;
            $transaction->status=Helper::STATUSPENDING;
            $transaction->save();
            $customer->balance-=$rate['total_local'];
            $customer->save();
            DB::commit();
            notify()->success('Data has been saved successfully!');
            return redirect()->route('secure.transferList');
        }
        return view('secure.make_mobil', [
            'countries' => $countries,
            'beneficiaries' => $beneficiaries,
            'relactions' => $relactions,
            'wallets' => $gateways,
            'originFonds' => $originFonds,
            'senders' => $senders,
            'raisons' => $raisonTosend,
        ]);
    }
    public function make_bank(Request $request)
    {
        $auth = Auth::user();
        $customer = Customer::query()->firstWhere(['user_id' => $auth->id]);
        $senders = Sender::query()->where(['customer_id'=>$customer->id])->get();
        $beneficiaries = Beneficiary::query()->where(['customer_id'=>$customer->id])->get();
        $wallet = [];
        $countries = Country::all();
        $originFonds = [];
        $relactions = [];
        $raisonTosend = [];

        $base = config('app.API_DOMAINCONFIG');

        $responseOriginFond = Http::get($base . 'wace_origin_fond.json');
        $responseRelation = Http::get($base . 'wace_relaction.json');
        $responseRaisonSend = Http::get($base . 'wace_raison_to_send.json');

        $gateways = [
            'AGENSICPAY_ALL'
        ];
        if ($responseOriginFond->successful()) {
            $originFonds = $responseOriginFond->json()['data'];
        }
        if ($responseRaisonSend->successful()) {
            $raisonTosend = $responseRaisonSend->json()['data'];
        }
        if ($responseRelation->successful()) {
            $relactions = $responseRelation->json()['data'];
        }
        if ($request->method() == 'POST') {
            $validator = Validator::make($request->all(), [
                'countryCode' => 'required',
                'wallet' => 'required',
                'gateway_id' => 'required',
                'numSender' => 'required',
                'numBeneficiary' => 'required',
                'numCity' => 'required',
                'amount' => 'required',
                'raison_transaction' => 'required',
                'origin_fond' => 'required',
                'relation' => 'required',
                'accountNumber' => 'required',
            ], [
                'amount' => 'Password must contain 4 characters',
                'password.max' => 'Password must contain 14 characters',
            ]);
            if ($validator->fails()) {
                // Utilisez notify pour afficher les erreurs
                foreach ($validator->errors()->all() as $error) {
                    notify()->error($error);
                }

                return redirect()->back()->withInput();
            }
            $amount=$request->get('amount');
            $rate=$this->calculRate($request->countryCode,$customer->id,$amount);
            if ($rate['status']==0){
                notify()->error('unauthorized for this country');
                return redirect()->back()->withInput();
            }
            $amount_total=$rate['total'];
            if ($customer->balance<$rate['total_local']){
                notify()->error('Balance Insufficient');
                return redirect()->back()->withInput();
            }
            DB::beginTransaction();
            $transaction=new Transaction();
            $transaction->sender_id=$request->get('numSender');
            $transaction->relation=$request->get('relation');
            $transaction->origin_fond=$request->get('origin_fond');
            $transaction->motif_send=$request->get('raison_transaction');
            $transaction->accountNumber=$request->get('accountNumber');
            $transaction->wallet=$request->get('wallet');
            $transaction->iban=$request->get('iban');
            $transaction->beneficiary_id=$request->get('beneficiary_id');
            $transaction->gateway_id=$request->get('gateway_id');
            $transaction->beneficiary_id=$request->get('numBeneficiary');
            $transaction->city=$request->get('numCity');
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
            Helper::create_journal_Transfer($rate['total_local'],$customer->id,$customer->balance);
            $customer->balance-=$rate['total_local'];
            $customer->save();
            DB::commit();
            try {
                $response= $this->waceService->sendTransaction($transaction);
                if ($response['status'] !==2000){
                    $transaction->status=Helper::STATUSFAILD;
                    Helper::create_journal_transfer_cancel($rate['total_local'],$customer->id,$customer->balance);
                    $customer->balance+=$rate['total_local'];
                    $customer->save();
                    notify()->error('Internal error');
                    return redirect()->back()->withInput();
                }else{
                    $transaction->reference_partner=$response['reference'];
                    $transaction->status=Helper::STATUSPROCESSING;
                }
                $transaction->save();
            }catch (\Exception $exception){
                logger($exception->getMessage());
                $transaction->status=Helper::STATUSFAILD;
                $transaction->save();
                Helper::create_journal_transfer_cancel($rate['total_local'],$customer->id,$customer->balance);
                $customer->balance+=$rate['total_local'];
                $customer->save();
                notify()->error('Internal error');
                return redirect()->back()->withInput();
            }

            notify()->success('Data has been saved successfully!');
            return redirect()->route('secure.transferList');
        }
        return view('secure.make_bank', [
            'countries' => $countries,
            'beneficiaries' => $beneficiaries,
            'relactions' => $relactions,
            'wallets' => $gateways,
            'originFonds' => $originFonds,
            'senders' => $senders,
            'raisons' => $raisonTosend,
        ]);
    }

    public function senders(Request $request)
    {
        $auth = Auth::user();
        $customer = Customer::query()->firstWhere(['user_id' => $auth->id]);
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $items = Sender::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $items = new Sender();
        }
        $items = $items->where(['customer_id' => $customer->id])->orderByDesc('created_at')->paginate(20)->appends($query_param);

        return view('secure.senders', [
            'senders' => $items
        ]);
    }

    public function addSender(Request $request)
    {
        $countries = Country::all();
        $auth = Auth::user();
        $customer = Customer::query()->firstWhere(['user_id' => $auth->id]);
        if ($request->method() == 'POST') {
            logger($customer);
            $body = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'date_birth' => $request->date_birth,
                'num_document' => $request->num_document,
                'country' => $request->country,
                'phone' => $request->phone,
                'identification_document' => $request->identification_document,
                'occupation' => $request->occupation,
                'civility' => $request->civility,
                'gender' => $request->gender,
                'expired_document' => $request->expired_document,
                'code' => Helper::generatenumber(),
                'address' => $request->address,
                'city' => $request->numCity,
                'customer_id' => $customer->id

            ];
            $sender = new Sender($body);
            $sender->save($body);
            notify()->success('Data has been saved successfully!');
            return redirect()->route('secure.senders');

        }
        return view('secure.addSender', [
            'countries' => $countries
        ]);
    }

    public function beneficiaries(Request $request)
    {
        $auth = Auth::user();
        $customer = Customer::query()->firstWhere(['user_id' => $auth->id]);
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $items = Beneficiary::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $items = new Beneficiary();
        }
        $items = $items->where(['customer_id' => $customer->id])->orderByDesc('created_at')->paginate(20)->appends($query_param);

        return view('secure.beneficiaries', [
            'numSender' => $request->get('code'),
            'beneficiaries' => $items
        ]);
    }
    public function transaction_detail(Request $request,$numero_identifiant)
    {
        return view('secure.transaction-detail', [
           'transaction'=>Transaction::query()->firstWhere(['number_transaction'=>$numero_identifiant])
        ]);
    }
    public function addBeneficiaries(Request $request)
    {
        $auth = Auth::user();
        $customer = Customer::query()->firstWhere(['user_id' => $auth->id]);
        if ($request->method() == 'POST') {
            $body = [
                'numSender' => $request->get('numSender'),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'date_birth' => $request->date_birth,
                'num_document' => $request->num_document,
                'country' => $request->country,
                'phone' => $request->phone,
                'identification_document' => $request->identification_document,
                'zipcode' => $request->zipcode,
                'civility' => $request->civility,
                'gender' => $request->gender,
                'expired_document' => $request->expired_document,
                'code' => Helper::generatenumber(),
                'address' => '',
                'city' => '','occupation'=>'',
                'customer_id' => $customer->id
            ];
            $beneficiary = new Beneficiary($body);
            $beneficiary->save($body);
            notify()->success('Data has been saved successfully!');
            return redirect()->route('secure.beneficiaries');
        }
        return view('secure.addBeneficiary', [
            'countries' => Country::all(),
        ]);
    }

    public function getBeneficiaryAjax(Request $request)
    {
        $beneficiaries = [];
        $response = $this->api->get('beneficiaries', [
            'numSender' => $request->get('numSender')
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $beneficiaries = $data['data'];
        }
        return response()->json(['data' => $beneficiaries, 'status' => true]);
    }

    public function getCitiesAjax(Request $request)
    {
        $cities = City::query()->where(['country_id'=>$request->get('country_id')])->get();

        return response()->json(['data' => $cities, 'status' => true]);
    }
    public function getRateAjax(Request $request)
    {
        $auth = Auth::user();
        $customer = Customer::query()->firstWhere(['user_id' => $auth->id]);

        return response()->json(['data' => $this->calculRate($request->country_id,$customer->id,$request->amount), 'status' => true]);
    }

    public function getOperatorsAjax(Request $request)
    {
        if ($request->get('method') === 'AGENSICPAY_ALL') {
            $getway = 'WACEPAY';
        } elseif ($request->get('method') === 'AGENSICPAY_XAF') {
            $getway = 'AGENSICPAY';
        } else {
            $getway = 'PAYDUNYA';
        }
        $gateways = Gateway::query()->where(['method'=>$getway,'country_id'=>$request->get('country_id')])->get();

        return response()->json(['data' => $gateways, 'status' => true]);
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
            'value'=>[
                'total'=>number_format($amount*$rate_country->rate,2),
                'costs'=>number_format($costs+$rate_country->fixed_amount,2),
                'total_local'=>number_format($value,2),
                'rate'=>number_format($rate_country->rate,5)
            ],
            'total'=>$amount*$rate_country->rate,
            'costs'=>$costs+$rate_country->fixed_amount,
            'total_local'=>$value,
            'rate'=>$rate_country->rate
        ];
    }
}
