<?php


namespace App\Http\Controllers;




use App\Services\RemoteApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use function Illuminate\Foundation\Configuration\api;
use function Illuminate\Routing\redirectToRoute;

class SecureController extends Controller
{
private $api;
    private $base_url;

    /**
     * SecureController constructor.
     * @param RemoteApiService $api
     */
    public function __construct(RemoteApiService $api)
    {
        $this->base_url=config('app.API_DOMAINCONFIG').'api/';
        $this->api=$api;
    }

    public function secureLogin(Request $request)
    {
        if ($request->method()=='POST'){
            $email=$request->get('email');
            $password=$request->get('password');
           $res= $this->api->login($email,$password);

           if (!is_null($res)){
               notify()->success('Data has been saved successfully!');

               return redirect()->route('secure.dashboard');
           }
            notify()->error('An error has occurred please try again later.');
        }

        return view('secure.auth.login', [

        ]);
    }
    public function secureRegister(Request $request)
    {
        if ($request->method()=='POST'){
            $email=$request->get('email');
            $password=$request->get('password');
            $name=$request->get('name');
            $phone=$request->get('phone');

            $response= $this->api->post('wtc_partners',[
                'phone'=>$phone,
                'email'=>$email,
                'name'=>$name,
                'password'=>$password
            ]);

            if ($response->successful()) {
                notify()->success('Data has been saved successfully!');

                $res= $this->api->login($email,$password);
                if (!is_null($res)){
                    notify()->success('Data has been saved successfully!');
                    return redirect()->route('secure.dashboard');
                }
            }
            notify()->error('An error has occurred please try again later.');
        }

        return view('secure.auth.register', [

        ]);
    }
    public function dashboard(Request $request)
    {

        return view('secure.dashbord', [

        ]);
    }
    public function transferList(Request $request)
    {

        return view('secure.transferList', [

        ]);
    }
    public function make_mobil(Request $request)
    {

        return view('secure.make_mobil', [

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
        $response = $this->api->get('countries');
        $responseSender = $this->api->get('senders');
        $responseOriginFond = Http::get($base.'wace_origin_fond.json');
        $responseRelation= Http::get($base.'wace_relaction.json');
        $responseRaisonSend = Http::get($base.'wace_raison_to_send.json');
        $responseWallets = $this->api->get('gateways');


        if ($response->successful()) {
            $data = $response->json();
            $countries=$data['data'];
        }

        if ($responseSender->successful()) {
            $data = $responseSender->json();
            $senders=$data['data'];
        }
        if ($responseWallets->successful()) {
            $wallet=$responseWallets->json()['data'];
        }
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
            $resp = $this->api->post('transactions/bank',$body);
            logger($resp);
            if ($resp->successful()) {
                notify()->success('Data has been saved successfully!');
                return redirect()->route('secure.transferList');
            }
            notify()->error('An error has occurred please try again later.');
        }
        return view('secure.make_bank', [
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
        $senders=[];
        $response = $this->api->get('senders');
        if ($response->successful()) {
            $data = $response->json();
            $senders=$data['data'];
        }
        return view('secure.senders', [
            'senders'=>$senders
        ]);
    }
    public function addSender(Request $request)
    {
        $countries=[];
        $response =  $this->api->get('countries');
        if ($response->successful()) {
            $data = $response->json();
            $countries=$data['data'];
        }
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
            $resp =  $this->api->post('senders',$body);
            if ($resp->successful()) {
                notify()->success('Data has been saved successfully!');
                return redirect()->route('secure.senders');
            }
            notify()->error('An error has occurred please try again later.');
        }
        return view('secure.addSender', [
            'countries'=>$countries
        ]);
    }
    public function beneficiaries(Request $request)
    {
        $beneficiaries=[];
        $response = $this->api->get('beneficiaries',[
           'numSender'=> $request->get('numSender')
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $beneficiaries=$data['data'];
           // notify()->success('Data has been saved successfully!');
        }

        return view('secure.beneficiaries', [
            'numSender'=>$request->get('numSender'),
            'beneficiaries'=>$beneficiaries
        ]);
    }
    public function addBeneficiaries(Request $request)
    {
        $countries=[];
        $senders=[];
        $response = $this->api->get('countries');
        if ($response->successful()) {
            $data = $response->json();
            $countries=$data['data'];
        }
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
                return redirect()->route('secure.beneficiaries');
            }
            notify()->error('An error has occurred please try again later.');
        }
        return view('secure.addBeneficiary', [
            'countries'=>$countries,
            'senders'=>$senders
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
