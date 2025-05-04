<?php

namespace App\Livewire;

use App\Helpers\Helper;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DetailDeposit extends Component
{
    public $deposit;
    public $isOpen = false;

    // Fonction pour ouvrir le modal
    public function openModal()
    {
        $this->isOpen = true;
    }

    // Fonction pour fermer le modal
    public function closeModal()
    {
        $this->isOpen = false;
    }
    public function validateDeposit()
    {
        DB::beginTransaction();

       $this->deposit->status=Helper::STATUSSUCCESS;
        $custome=Customer::query()->find($this->deposit->customer_id);
        $balance_old=$custome->balance;
        $custome->balance+=$this->deposit->amount;
        $custome->save();
        Helper::create_journal_deposit($this->deposit->amount,$custome->id,$balance_old);
        $this->deposit->save();
        DB::commit();
        $this->redirect('/deposits');
    }
    public function cancelDeposit()
    {
        DB::beginTransaction();

        $this->deposit->status=Helper::STATUSREJECTED;
        $custome=Customer::query()->find($this->deposit->customer_id);
        $balance_old=$custome->balance;
        Helper::create_journal_deposit_cancel($this->deposit->amount,$custome->id,$balance_old);
        $this->deposit->save();
        DB::commit();
        $this->redirect('/deposits');
    }

    public function render()
    {
        return view('livewire.detail-deposit');
    }
}
