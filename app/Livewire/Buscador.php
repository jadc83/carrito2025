<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Component;

class Buscador extends Component
{
    public $productos;
    public $criterio;

    public function render()
    {
        return view('livewire.buscador');
    }

    public function mount()
    {
        $this->productos = Producto::all();
    }

    public function buscar()
    {
        $this->productos = Producto::where('nombre', 'ILIKE', "%$this->criterio%")->get();
    }

}
