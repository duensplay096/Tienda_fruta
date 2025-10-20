<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $producto->id ? 'Editar Producto' : 'Agregar Producto' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50">

    <div class="max-w-lg mx-auto bg-white p-6 mt-10 rounded-xl shadow">
        <h1 class="text-2xl font-bold text-center mb-6">
            {{ $producto->id ? 'Editar Producto' : 'Agregar Producto' }}
        </h1>

        <form method="POST" action="{{ $producto->id ? route('productos.update', $producto) : route('productos.store') }}" enctype="multipart/form-data">
            @csrf
            @if($producto->id)
                @method('PUT')
            @endif

            <div class="mb-4">
                <label class="block mb-1 font-medium">Nombre</label>
                <input type="text" name="nombre" class="w-full border-gray-300 rounded p-2"
                       value="{{ old('nombre', $producto->nombre) }}" required>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Descripción</label>
                <textarea name="descripcion" class="w-full border-gray-300 rounded p-2">{{ old('descripcion', $producto->descripcion) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Precio</label>
                <input type="number" name="precio" step="0.01" class="w-full border-gray-300 rounded p-2"
                       value="{{ old('precio', $producto->precio) }}" required>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('inicio') }}" class="bg-gray-400 hover:bg-gray-500 text-white py-2 px-4 rounded">Cancelar</a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded">
                    Guardar
                </button>
            </div>
        </form>
    </div>

</body>
</html>
