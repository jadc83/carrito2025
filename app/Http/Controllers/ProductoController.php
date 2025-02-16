<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        $carrito = session()->get('carrito', []);

        return view('productos.index', ['productos' => $productos, 'carrito' => $carrito]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:productos,nombre',
            'precio' => 'required|numeric|between:0,999999.99',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'nombre.unique' => 'El producto ya existe en la base de datos',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número válido.',
            'precio.between' => 'El precio debe estar entre 0 y 999999.99.',
        ]);

        $producto = new Producto();
        $producto->fill($validated);
        $producto->save();
        session()->flash('exito', 'Los cambios se guardaron correctamente.');
        return redirect()->route('productos.index', $producto);
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return view('productos.show', ['producto' => $producto]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('productos.edit', ['producto' => $producto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|between:0,999999.99',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número válido.',
            'precio.between' => 'El precio debe estar entre 0 y 999999.99.',
        ]);

        $producto->update($validated);
        session()->flash('exito', 'Los cambios se guardaron correctamente.');

        return redirect()->route('productos.index', $producto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index');
    }

    public function comprar(Producto $producto)
    {

    }

        /**
     * Añade un producto al carrito desde la vista del carrito
     */

     public function add($id)
    {
        $producto = Producto::findOrFail($id);
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => 1
            ];
        }

        session()->put('carrito', $carrito);
        session()->flash('exito', 'Producto añadido al carrito.');

        return redirect()->route('productos.index');

    }

         /**
     * Resta un producto al carrito desde la vista del carrito
     */

     public function resta($id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            if ($carrito[$id]['cantidad'] > 1) {
                $carrito[$id]['cantidad']--;
            } else {
                unset($carrito[$id]);
            }
            session()->put('carrito', $carrito);
        }

        session()->flash('exito', 'Producto eliminado del carrito.');

        return redirect()->route('productos.index');
    }
         /**
     * Crea una factura, enlaza los productos del carrito, los asigna a la factura y vacia el carrito
     */

    public function pagar()
    {

    }
         /**
     * Vacia el carrito
     */

    public function vaciar()
    {
        session()->forget('carrito');
        return redirect()->route('micarrito');
    }
}
