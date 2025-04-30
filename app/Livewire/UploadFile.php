<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class UploadFile extends Component
{
    use WithFileUploads;

    public $photo;
    public $visible = false;

    protected $listeners = ['formValidated' => 'show'];

    public function show()
    {
        $this->visible = true;
    }
    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:2048',
        ]);
        // Émettre un événement pour envoyer la photo au parent dès que l'image est téléchargée
        if ($this->photo) {
        /*    if ($this->photo) {
                $this->dispatch('make-deposit', 'photoUpdated', $this->photo);
            }*/
            $this->dispatch('photoUpdated', $this->photo);
        }
    }

    public function render()
    {
        return view('livewire.upload-file');
    }
}
