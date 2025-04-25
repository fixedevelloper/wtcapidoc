<?php


namespace App\Http\Controllers\Admin;


use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Sender;
use App\Models\Transaction;
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
}
