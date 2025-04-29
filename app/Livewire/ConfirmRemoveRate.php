<?php

namespace App\Livewire;

use App\Models\Rate;
use Livewire\Component;

class ConfirmRemoveRate extends Component
{
    public $rate;
    public $isOpen = false; // Contrôle l'état du modal

    // Fonction pour ouvrir le modal
    public function openModal()
    {
        $this->isOpen = true;
    }

    public function delete(){
        $tr=Rate::query()->find($this->rate->id);
        $tr->delete();
        $this->closeModal();
    }
    // Fonction pour fermer le modal
    public function closeModal()
    {
        $this->isOpen = false;
        $this->redirect('/customers/rate/'.$this->rate->customer_id);

    }

    public function render()
    {
        return view('livewire.confirm-remove-rate');
    }
}
