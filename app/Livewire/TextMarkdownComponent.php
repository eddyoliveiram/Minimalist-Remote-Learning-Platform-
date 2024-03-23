<?php

namespace App\Livewire;

use Livewire\Component;

class TextMarkdownComponent extends Component
{
    public $text; // This property binds to your input

    public function render()
    {
        return view('livewire.text-markdown-component');
    }

}

