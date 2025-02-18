<?php

namespace App\Livewire;
use Livewire\Component;

class Contador extends Component
{
    public $productos;
    public $total;

    public function render()
    {
        return view('livewire.contador');
    }

    public function mount()
    {
        $this->productos = session('carrito', []);
        $this->total = 0;
    }
}
