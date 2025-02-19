<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Component;

class Buscador extends Component
{
    public $productos;
    public $criterio;
    public $columna = 'nombre';
    public $sentido = 'asc'; // Debe ser pública
    public $total;

    public function render()
    {
        return view('livewire.buscador');
    }

    public function mount()
    {
        $this->productos = Producto::all();
        $this->total = 0;
    }

    public function buscar()
    {

        $this->productos = Producto::where('nombre', 'ILIKE', "%$this->criterio%")
                                   ->orderBy($this->columna, $this->sentido)
                                   ->get();
    }

    public function ordenar($campo)
    {
        if ($this->columna === $campo) {
            $this->sentido = ($this->sentido === 'asc') ? 'desc' : 'asc';
        } else {
            $this->columna = $campo;
            $this->sentido = 'asc';
        }

        // Reconsultar los productos con el nuevo orden
        $this->productos = Producto::orderBy($this->columna, $this->sentido)
                                   ->get();
    }

}
