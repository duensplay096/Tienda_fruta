<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Frutas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50">

    <header class="bg-green-600 text-white px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">Tienda de Frutas</h1>
        <a href="{{ route('productos.form') }}" class="bg-white text-green-600 font-semibold px-3 py-2 rounded hover:bg-green-100">
            Agregar producto
        </a>
    </header>

    <main class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($productos as $producto)
            <div class="bg-white p-4 rounded-lg shadow">
                <h2 class="text-lg font-bold text-green-700">{{ $producto->nombre }}</h2>
                <p class="text-gray-600">{{ $producto->descripcion }}</p>

                <p class="text-sm text-gray-500 mt-2">
                    Tipo: 
                    <span class="font-semibold text-green-700">
                        {{ $producto->tipo ? $producto->tipo->nombre : 'Sin tipo asignado' }}
                    </span>
                </p>

                <p class="font-semibold text-green-600 mt-2">
                    ${{ number_format($producto->precio, 0, ',', '.') }} COP
                </p>

                <div class="mt-4 flex justify-between">
                    <a href="{{ route('productos.edit', $producto) }}" class="text-blue-500 hover:underline">Editar</a>
                    <form action="{{ route('productos.destroy', $producto) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="col-span-3 text-center text-gray-500">No hay productos registrados.</p>
        @endforelse
    </main>

</body>
</html>
