<?php

namespace App\Livewire;

use App\Models\Country;
use Livewire\Component;
use Livewire\WithFileUploads;

class MakeDeposit extends Component
{

    public $photo;
    public $name;
    public $country;
    public $amount;
    public $phone;
    public $type_payment = 'mobile_money';
    public $visible = true;
    public function submit()
    {

      logger($this->amount);
        $this->dispatch('formValidated');
      $this->visible=false;
    }
    public function render()
    {
        return view('livewire.make-deposit',['countries'=>Country::all()]);
    }
}
