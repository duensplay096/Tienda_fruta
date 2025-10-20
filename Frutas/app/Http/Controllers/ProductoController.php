<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Mostrar productos
    public function index()
    {
        $productos = Producto::all();
        return view('inicio', compact('productos'));
    }

    // Mostrar formulario para crear producto
    public function create()
    {
        return view('productos.form', ['producto' => new Producto()]);
    }

    // Guardar producto
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric',
        ]);

        Producto::create($data);
        return redirect()->route('inicio')->with('success', 'Producto agregado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(Producto $producto)
    {
        return view('productos.form', compact('producto'));
    }

    // Actualizar producto
    public function update(Request $request, Producto $producto)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric',
        ]);

        $producto->update($data);
        return redirect()->route('inicio')->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar producto
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('inicio')->with('success', 'Producto eliminado correctamente.');
    }
}
