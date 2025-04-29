<?php


namespace App\Http\Controllers\Admin;


use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\DepositRequest;
use App\Models\Journal;
use App\Models\Sender;
use App\Models\Transaction;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transactions(Request $request)
    {
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $items = Transaction::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $items = new Transaction();
        }
        $items = $items->where(['type'=>Helper::TYPESECURE])->orderByDesc('created_at')->paginate(20)->appends($query_param);
        return view('admin.transactions', [
            'transactions'=>$items
        ]);
    }
    public function transaction_sandbox(Request $request)
    {
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $items = Transaction::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $items = new Transaction();
        }
        $items = $items->where(['type'=>Helper::TYPESANDBOX])->orderByDesc('created_at')->paginate(20)->appends($query_param);
        return view('admin.transaction_sandbox', [
            'transactions'=>$items
        ]);
    }
    public function transaction_detail(Request $request,$numero_identifiant)
    {
        return view('admin.transaction-detail', [
            'transaction'=>Transaction::query()->firstWhere(['number_transaction'=>$numero_identifiant])
        ]);
    }
    public function withdraws(Request $request)
    {
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $items = WithdrawRequest::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $items = new WithdrawRequest();
        }
        $items = $items->where([])->orderByDesc('created_at')->paginate(20)->appends($query_param);
        return view('admin.withdraws', [
            'withdraws'=>$items
        ]);
    }
    public function deposits(Request $request)
    {
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $items = DepositRequest::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $items = new DepositRequest();
        }
        $items = $items->where([])->orderByDesc('created_at')->paginate(20)->appends($query_param);
        return view('admin.deposits', [
            'deposits'=>$items
        ]);
    }
    public function journals(Request $request)
    {
        $query_param = [];
        $search = $request->search;
        if ($request->has('search')) {
            $items = Journal::query()->where('name', 'like', "%$search%")
                ->orWhere('iso', 'like', "%$search%");
            $query_param = ['search' => $request['search']];
        } else {
            $items = new Journal();
        }
        $items = $items->where([])->orderByDesc('created_at')->paginate(20)->appends($query_param);
        return view('admin.journals', [
            'journals'=>$items
        ]);
    }
}
