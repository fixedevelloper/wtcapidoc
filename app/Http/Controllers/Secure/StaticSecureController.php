<?php


namespace App\Http\Controllers\Secure;


use App\Helpers\Helper;
use App\Helpers\UploadableTrait;
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
use App\Services\PaymentMobilService;
use App\Services\WaceApiService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class StaticSecureController extends Controller
{
    use UploadableTrait;
    protected $waceService;
    protected $paymentMobileService;

    /**
     * StaticSecureController constructor.
     * @param WaceApiService $waceService
     * @param PaymentMobilService $paymentMobileService
     */
    public function __construct(WaceApiService $waceService,PaymentMobilService $paymentMobileService)
    {
        $this->waceService = $waceService;
        $this->paymentMobileService=$paymentMobileService;
    }

    public function dashboard(Request $request)
    {
        $customer=Customer::query()->firstWhere(['user_id'=>\auth()->user()->id]);
        $last_transactions=Transaction::query()->where(['type'=>Helper::TYPESECURE])
            ->where('status',Helper::STATUSSUCCESS)
            ->where('customer_id',$customer->id)->latest()->limit(5)->get();
        $startOfWeekend = Carbon::now()->startOfWeek()->addDay(5); // Samedi
        $endOfWeekend = Carbon::now()->startOfWeek()->addDay(6)->endOfDay();
        $sumWeekendTransactions = Transaction::query()
            ->where('customer_id',$customer->id)
            ->where('type',Helper::TYPESECURE)
            ->where('status',Helper::STATUSSUCCESS)
            ->whereBetween('created_at', [$startOfWeekend, $endOfWeekend])
            ->sum('amount');
        $sumTotal=Transaction::query()->where('customer_id',$customer->id)
            ->where('status',Helper::STATUSSUCCESS)
            ->where('type',Helper::TYPESECURE)->sum('amount');
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $sumCurrentMonthTransactions = Transaction::query()->where('customer_id',$customer->id)
            ->where('status',Helper::STATUSSUCCESS)
            ->where('type',Helper::TYPESECURE)->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('amount');
        $sumDepositTotal=DepositRequest::query() ->where('status',Helper::STATUSSUCCESS)->where('customer_id',$customer->id)->sum('amount');
        return view('secure.dashbord', [
            'customer'=>$customer,
            'last_transactions'=>$last_transactions,
            'sumWeekendTransactions'=>$sumWeekendTransactions,
            'sumTotal'=>$sumTotal,
            'sumCurrentMonthTransactions'=>$sumCurrentMonthTransactions,
            'sumDepositTotal'=>$sumDepositTotal
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
            $items = Transaction::query()
                ->leftJoin('senders', 'transactions.sender_id', '=', 'senders.id')
                ->where('type',Helper::TYPESECURE)
                ->where((DB::raw("CONCAT(senders.first_name, ' ', senders.last_name)")), 'like', "%$search%")
                //->orWhere((DB::raw("CONCAT(beneficiaries.first_name, ' ', beneficiaries.last_name)")), 'like', "%$search%")
                ->orWhere('number_transaction', 'like', "%$search%")
                ->orWhere('transactions.created_at', 'like', "%$search%");

            $query_param = ['search' => $request['search']];
        } else {
            $items = new Transaction();
        }
        $items = $items->where(['transactions.customer_id' => $customer->id,'type'=>Helper::TYPESECURE])->orderByDesc('transactions.created_at')->paginate(20)->appends($query_param);

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
        $countries = Rate::query()->where(['customer_id'=>$customer->id])->get();
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
                //'wallet' => 'required',
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
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();
            $sender=Sender::query()->find($request->get('numSender'));
            $sumCurrentMonthTransactions = Transaction::query()->where('type',Helper::TYPESECURE)->where('sender_id',$sender->id)
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->sum('amount');

            if ($sumCurrentMonthTransactions+$amount>$sender->max_transaction){
                notify()->error('Limit transaction','Transaction status');
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
            try {
                $response=$this->paymentMobileService->makePayment($transaction);
                if (!$response['status']){
                    $transaction->status=Helper::STATUSFAILD;
                    Helper::create_journal_transfer_cancel($rate['total_local'],$customer->id,$customer->balance);
                    $customer->balance+=$rate['total_local'];
                    $customer->save();
                    $transaction->save();
                    notify()->error($response['message'],'Transaction status');
                    return redirect()->back()->withInput();
                }
            }catch (\Exception $exception){
                $transaction->status=Helper::STATUSFAILD;
                Helper::create_journal_transfer_cancel($rate['total_local'],$customer->id,$customer->balance);
                $customer->balance+=$rate['total_local'];
                $customer->save();
                $transaction->save();
                notify()->error('Internal error','Transaction status');
                return redirect()->back()->withInput();
            }
            notify()->success('Data has been saved successfully!','Transaction status');
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
        $countries = Rate::query()->where(['customer_id'=>$customer->id])->get();
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
                //'wallet' => 'required',
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
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();
            $sender=Sender::query()->find($request->get('numSender'));
            $sumCurrentMonthTransactions = Transaction::query()->where('type',Helper::TYPESECURE)
                ->where('sender_id',$sender->id)->where('status',Helper::STATUSSUCCESS)
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->sum('amount');
            if ($sumCurrentMonthTransactions+$amount>$sender->max_transaction){
                notify()->error('Limit transaction','Transaction status');
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
            $transaction->rounting_number=$request->get('routing_number');
            $transaction->ifsc_code=$request->get('ifsc');
            $transaction->branch_number=$request->get('branch_number');
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
            $items = Sender::query()->where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%$search%")
                // ->orWhere('last_name', 'like', "%$search%")
                ->orWhere('code', 'like', "%$search%");
           /* $items = Sender::query()->where('first_name', 'like', "%$search%")
                ->orWhere('last_name', 'like', "%$search%")
                ->orWhere('code', 'like', "%$search%");*/
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
    public function editSender(Request $request,$code)
    {
        $countries = Country::all();
        $sender = Sender::query()->firstWhere(['code'=>$code]);
        if ($request->method() == 'POST') {
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
                'address' => $request->address,
                'city' => $request->numCity,

            ];
            $sender->update($body);
            notify()->success('Data has been saved successfully!');
            return redirect()->route('secure.senders');

        }
        return view('secure.editSender', [
            'countries' => $countries,
            'sender'=>$sender
        ]);
    }
    public function beneficiaries(Request $request)
    {
        $auth = Auth::user();
        $customer = Customer::query()->firstWhere(['user_id' => $auth->id]);
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $items = Beneficiary::query()->where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%$search%")
               // ->orWhere('last_name', 'like', "%$search%")
                ->orWhere('code', 'like', "%$search%");
           /* $items = Beneficiary::query()->where('first_name', 'like', "%$search%")
                ->orWhere('last_name', 'like', "%$search%")
                ->orWhere('code', 'like', "%$search%");*/
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
    public function make_deposit(Request $request)
    {
        $auth = Auth::user();
        $customer = Customer::query()->firstWhere(['user_id' => $auth->id]);
        if ($request->method()=='POST'){
            $deposit=new DepositRequest();
            $deposit->customer_id=$customer->id;
            $deposit->amount=$request->amount;
            $deposit->type=$request->type;
           //  $deposit->name=$request->name;
            $deposit->phone=$request->phone;
            $deposit->status=Helper::STATUSPROCESSING;
            if ($request->hasFile('proof') && $request->file('proof') instanceof UploadedFile) {
                $flag = $this->storeFile($request->file('proof'), 'proofs');
                $deposit->proof_image = $flag;
            }
            $deposit->save();
            return redirect()->route('secure.deposits');
        }
        return view('secure.make_deposit', [
            'countries'=>Country::all()
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
    public function editBeneficiaries(Request $request,$code)
    {
        $beneficiary = Beneficiary::query()->firstWhere(['code'=>$code]);
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
                'address' => '',
                'city' => '',
                'occupation'=>'',
            ];
            $beneficiary->update($body);
            notify()->success('Data has been saved successfully!');
            return redirect()->route('secure.beneficiaries');
        }
        return view('secure.editBeneficiary', [
            'countries' => Country::all(),
            'beneficiary'=>$beneficiary
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
        $country=Country::query()->find($request->get('country_id'));
        $cities = City::query()->where(['country_id'=>$request->get('country_id')])->get();
        if ($request->get('type')=='mobil'){
            $gateways=Gateway::query()->where(['method'=>$country->code_gateway_mobil,'country_id'=>$country->id])->get();
        }else{
            $gateways=Gateway::query()->where(['method'=>$country->code_gateway_bank,'country_id'=>$country->id])->get();
        }

        return response()->json(['data' => $cities, 'gateways'=>$gateways, 'status' => true]);
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
            $type='BANK';
        } elseif ($request->get('method') === 'AGENSICPAY_XAF') {
            $getway = 'AGENSICPAY';
            $type='MOBIL';
        } else {
            //$getway = 'PAYDUNYA';
            $getway = 'WACEPAY';
            $type='MOBIL';
        }
        $gateways = Gateway::query()->where(['method'=>$getway,'type'=>$type,'country_id'=>$request->get('country_id')])->get();

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
                'rate'=>number_format($rate_country->rate,5),
                'amount'=>number_format($amount,2)
            ],
            'total'=>$amount*$rate_country->rate,
            'costs'=>$costs+$rate_country->fixed_amount,
            'total_local'=>$value,
            'rate'=>$rate_country->rate
        ];
    }
    public function notifyPaydunnya(Request $request)
    {
        $data = $request->all();
        logger($data);
        $paymentStatus = $data['status'] ?? null;

        return response()->json(['data' => [$data],'status' => true]);
    }
}
