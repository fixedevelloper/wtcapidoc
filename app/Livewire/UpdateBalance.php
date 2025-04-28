<?php

namespace App\Livewire;

use App\Models\Customer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
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
        logger('upadet');
       $custome=Customer::query()->find($this->customer->id);
       $custome->balance+=$this->balance;

        $this->balance_old+=$this->balance;
       $custome->save();
        $this->reset('balance');

        $this->showModal = false;
    }
    public function render()
    {
        return view('livewire.update-balance',['customer'=>$this->customer]);
    }
}
