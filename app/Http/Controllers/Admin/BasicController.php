<?php


namespace App\Http\Controllers\Admin;


use App\Helpers\Helper;
use App\Helpers\UploadableTrait;
use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use App\Models\DepositRequest;
use App\Models\Gateway;
use App\Models\Rate;
use App\Models\Sender;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class BasicController extends Controller
{
    use UploadableTrait;
    public function dashboard(Request $request)
    {
        $last_transactions=Transaction::query()->where(['type'=>Helper::TYPESECURE])->latest()->limit(5)->get();
        $last_deposits=DepositRequest::query()->where([])->latest()->limit(5)->get();
        return view('admin.dashbord', [
            'transactions'=>$last_transactions,
            'deposits'=>$last_deposits
        ]);
    }
    public function customers(Request $request)
    {
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $items = Customer::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $items = new Customer();
        }
        $items = $items->where([])->orderByDesc('created_at')->paginate(20)->appends($query_param);

        return view('admin.customers', [
            'customers'=>$items

        ]);
    }
    public function senders(Request $request)
    {
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $items = Sender::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $items = new Sender();
        }
        $items = $items->where([])->orderByDesc('created_at')->paginate(20)->appends($query_param);
        return view('admin.senders', [
            'senders'=>$items
        ]);
    }
    public function beneficiaries(Request $request)
    {
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $items = Beneficiary::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $items = new Beneficiary();
        }
        $items = $items->where([])->orderByDesc('created_at')->paginate(20)->appends($query_param);
        return view('admin.beneficiaries', [
            'beneficiaries'=>$items

        ]);
    }
    public function countries(Request $request)
    {
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $items = Country::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $items = new Country();
        }
        $items = $items->where([])->orderByDesc('created_at')->paginate(20)->appends($query_param);
        return view('admin.countries', [
            'countries'=>$items
        ]);
    }
    public function cities(Request $request)
    {
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $items = City::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $items = new City();
        }
        $items = $items->where([])->orderByDesc('created_at')->paginate(20)->appends($query_param);
        return view('admin.cities', [
            'cities'=>$items
        ]);
    }
    public function gateways(Request $request)
    {
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $items = Gateway::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $items = new Gateway();
        }
        $items = $items->where([])->orderByDesc('created_at')->paginate(20)->appends($query_param);
        return view('admin.gateways', [
            'gateways'=>$items
        ]);
    }
    public function rates(Request $request)
    {
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $items = Rate::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $items = new Rate();
        }
        $items = $items->where([])->orderByDesc('created_at')->paginate(20)->appends($query_param);
        return view('admin.rates', [
            'rates'=>$items
        ]);
    }
    public function addrates(Request $request,$id)
    {
        if ($request->method()=='POST'){
            $rate=Rate::query()->firstWhere(['customer_id'=>$id,'country_id'=>$request->countryCode]);
            if (is_null($rate)){
                $rate=new Rate();
                $rate->rate=$request->rate;
                $rate->cost=$request->cost;
                $rate->fixed_amount=$request->fixed_amount;
                $rate->customer_id=$id;
                $rate->country_id=$request->countryCode;
                $rate->save();
            }
            notify()->warning('This rate exits');
        }
        $rates=Rate::query()->where(['customer_id'=>$id])->get();
        return view('admin.add.rate', [
            'rates'=>$rates,
            'customer'=>Customer::query()->find($id),
            'countries'=>Country::all()
        ]);
    }
    public function saveCountry(Request $request)
    {
        $country=new Country();
        $country->name=$request->name;
        $country->codeIso=$request->codeiso;
        $country->codeIso2=$request->codeiso2;
        $country->currency=$request->currency;
        if ($request->hasFile('flag') && $request->file('flag') instanceof UploadedFile) {
            $flag = $this->storeFile($request->file('flag'), 'flags');
            $country->flag = $flag;
        }
        $country->save();
        return redirect()->route('admin.countries');
    }
    public function customer_detail(Request $request,$code)
    {
        return view('admin.add.customer_detail', [
            'customer'=>Customer::query()->firstWhere(['id'=>$code])
        ]);
    }
    public function sender_detail(Request $request,$code)
    {
        return view('admin.add.sender_detail', [
            'sender'=>Sender::query()->firstWhere(['code'=>$code])
        ]);
    }
    public function beneficiary_detail(Request $request,$code)
    {
        return view('admin.add.beneficiary_detail', [
            'beneficiary'=>Beneficiary::query()->firstWhere(['code'=>$code])
        ]);
    }
}
