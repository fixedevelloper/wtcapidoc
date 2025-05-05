<?php

namespace App\Livewire;

use Livewire\Component;

class LimitTransaction extends Component
{
    public $isOpen = false;
    public $max_transaction;
    public $sender;
    public function mount($sender)
    {

        $this->max_transaction = $sender->max_transaction;

    }
    public function openModal()
    {
        $this->isOpen = true;
    }
    function save(){
       $this->sender->max_transaction=$this->max_transaction;
       $this->sender->save();
        $this->redirect('/senders');
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }
    public function render()
    {
        return view('livewire.limit-transaction');
    }
}
