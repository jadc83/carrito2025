<?php

namespace App\Livewire\Productos;

use Livewire\Component;
use App\Models\Producto;

class Show extends Component
{
    public $producto;

    public function mount($id)
    {
        $this->producto = Producto::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.productos.show');
    }
}
