<?php

namespace App\Livewire;

use Livewire\Component;

class ConfirmationModalComponent extends Component
{
    public bool $myModalConfirm = false; // Controls the modal visibility
    public $type;
    public $data;

    public function mount($data, $type)
    {
        $this->data = $data->{$type} ?? $data;
        $this->type = $type;
    }

    public function render()
    {
        return view('livewire.modal-component');
    }

    public function closeModal()
    {
        $this->myModalConfirm = false;
    }
}

