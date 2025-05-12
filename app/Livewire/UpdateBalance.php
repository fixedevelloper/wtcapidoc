<?php

namespace App\Livewire;

use App\Helpers\Helper;
use App\Models\Customer;
use App\Models\DepositRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class UpdateBalance extends Component
{
    use AuthorizesRequests;
    public $showModal = false;
    public $balance;
    public $balance_old=0.0;
    public $customer;
    public function mount($customer)
    {

        $this->balance_old = $customer->balance;

    }
    public function save()
    {
       DB::beginTransaction();
       $custome=Customer::query()->find($this->customer->id);
       $custome->balance+=$this->balance;
        $custome->save();
        $deposit=new DepositRequest();
        $deposit->customer_id=$custome->id;
        $deposit->amount=$this->balance;
        $deposit->status=Helper::STATUSSUCCESS;
        $deposit->save();
        Helper::create_journal_deposit($this->balance,$custome->id,$this->balance_old);
        $this->balance_old+=$this->balance;
        DB::commit();
        $this->reset('balance');
        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Données enregistrées avec succès !'
        ]);

        $this->showModal = false;
    }
    public function render()
    {
        return view('livewire.update-balance',['customer'=>$this->customer]);
    }
}
