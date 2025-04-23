<?php


namespace App\Http\Controllers\Admin;


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
        $items = $items->where([])->orderByDesc('created_at')->paginate(20)->appends($query_param);
        return view('admin.transactions', [
            'transactions'=>$items
        ]);
    }
}
