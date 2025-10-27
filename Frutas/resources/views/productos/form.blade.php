<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $producto->exists ? 'Editar' : 'Agregar' }} Producto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50">

    <div class="max-w-lg mx-auto mt-10 bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-6 text-green-700">
            {{ $producto->exists ? 'Editar producto' : 'Agregar producto' }}
        </h1>

        <form action="{{ $producto->exists ? route('productos.update', $producto) : route('productos.store') }}" method="POST">
            @csrf
            @if ($producto->exists)
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 font-medium mb-1">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="w-full border-gray-300 rounded p-2"
                       value="{{ old('nombre', $producto->nombre) }}" required>
            </div>

            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700 font-medium mb-1">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="w-full border-gray-300 rounded p-2" rows="3">{{ old('descripcion', $producto->descripcion) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="tipo_id" class="block text-gray-700 font-medium mb-1">Tipo de producto</label>
                <select name="tipo_id" id="tipo_id" class="w-full border-gray-300 rounded p-2" required>
                    <option value="">-- Selecciona un tipo --</option>
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo->id }}" {{ old('tipo_id', $producto->tipo_id) == $tipo->id ? 'selected' : '' }}>
                            {{ $tipo->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('tipo_id')
                    <p class="text-red-500 text-sm mt-1">Debe seleccionar un tipo de producto</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="precio" class="block text-gray-700 font-medium mb-1">Precio (COP)</label>
                <input type="number" name="precio" id="precio" class="w-full border-gray-300 rounded p-2"
                       value="{{ old('precio', $producto->precio) }}" required>
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('inicio') }}" class="text-gray-600 hover:underline">Volver</a>
                <button type="submit" class="bg-green-600 text-white font-semibold px-4 py-2 rounded hover:bg-green-700">
                    {{ $producto->exists ? 'Actualizar' : 'Guardar' }}
                </button>
            </div>
        </form>
    </div>

</body>
</html>
