<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Tipo; // 👈 Importamos el modelo Tipo
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Mostrar todos los productos
    public function index()
    {
        $productos = Producto::with('tipo')->get(); // 👈 Traemos también el tipo
        return view('inicio', compact('productos'));
    }

    // Mostrar formulario para crear producto
    public function create()
    {
        $tipos = Tipo::all(); // 👈 Para llenar el select de tipos
        return view('productos.form', [
            'producto' => new Producto(),
            'tipos' => $tipos
        ]);
    }

    // Guardar producto nuevo
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric',
            'tipo_id' => 'nullable|exists:tipos,id', // 👈 Validamos que el tipo exista
        ]);

        Producto::create($data);

        return redirect()->route('inicio')->with('success', 'Producto agregado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(Producto $producto)
    {
        $tipos = Tipo::all(); // 👈 Necesitamos los tipos también
        return view('productos.form', compact('producto', 'tipos'));
    }

    // Actualizar producto existente
    public function update(Request $request, Producto $producto)
    {
        $data = $request->validate([
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric',
            'tipo_id' => 'nullable|exists:tipos,id', // 👈 Validamos el tipo
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
