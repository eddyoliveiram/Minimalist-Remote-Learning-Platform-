<?php

namespace App\Livewire;

use Livewire\Component;

class ModalComponent extends Component
{
    public bool $myModal1 = false;

    public $type;
    public $data;

    public function mount($data, $type)
    {
        if ($type == 'students') {
            $this->data = $data->students;
        } else {
            if ($type == 'professors') {
                $this->data = $data->professors;
            }
        }
    }

    public function render()
    {
        return view('livewire.modal-component');
    }

    public function closeModal()
    {
        $this->myModal1 = false;
    }
}
