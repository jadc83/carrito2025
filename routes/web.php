<?php

use App\Http\Controllers\ProductoController;
use App\Livewire\Buscador;
use App\Models\Producto;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/carrito', function () {
    $carrito = session()->get('carrito', []);
    return view('productos.carrito', ['carrito' => $carrito]);
})->name('carrito');


Route::resource('/productos', ProductoController::class);

Route::post('/productos/{producto}/add', [ProductoController::class, 'add'])->name('productos.add');
Route::post('/productos/{producto}/comprar', [ProductoController::class, 'comprar'])->name('productos.comprar');
Route::post('/productos/{producto}/resta', [ProductoController::class, 'resta'])->name('productos.resta');
Route::post('/productos/vaciar', [ProductoController::class, 'vaciar'])->name('productos.vaciar');
Route::post('/productos/pagar', [ProductoController::class, 'pagar'])->name('productos.pagar');
Route::get('/buscador', Buscador::class);

require __DIR__.'/auth.php';
