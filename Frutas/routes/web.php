<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('/', [ProductoController::class, 'index'])->name('login');
Route::get('/productos/form', [ProductoController::class, 'create'])->name('productos.form');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');            

Route::get('/', function () {
    return view('login');
})->name('login');

// Procesar el formulario
Route::post('/login', function (Request $request) {
    $usuario = $request->input('usuario');
    $password = $request->input('password');

    // Usuario fijo (sin base de datos)
    if ($usuario === 'admin' && $password === '1234') {
        session(['logueado' => true]);
        return redirect()->route('inicio');
    }

    return back()->with('error', 'Usuario o contraseña incorrectos');
})->name('login.post');


Route::get('/inicio', function () {
    if (!session('logueado')) {
        return redirect()->route('login');
    }

    // Llamar manualmente al método index del controlador
    $controller = app(ProductoController::class);
    return $controller->index();
})->name('inicio');


// Cerrar sesión
Route::get('/logout', function () {
    session()->forget('logueado');
    return redirect()->route('login');
})->name('logout');