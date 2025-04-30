<?php

namespace App\Livewire;

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


    public function render()
    {
        return view('livewire.detail-deposit');
    }
}
