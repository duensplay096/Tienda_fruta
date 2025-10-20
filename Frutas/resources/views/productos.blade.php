<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Frutas 🍉</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 min-h-screen">

    <!-- HEADER -->
    <header class="bg-green-600 text-white py-4 shadow">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-2xl font-bold">🍏 Tienda de Frutas</h1>
            <a href="{{ route('productos.create') }}" 
               class="bg-white text-green-700 px-4 py-2 rounded hover:bg-green-100 transition">
               + Agregar producto
            </a>
        </div>
    </header>

    <!-- MENSAJES -->
    @if(session('success'))
        <div class="max-w-2xl mx-auto mt-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- LISTADO DE PRODUCTOS -->
    <main class="container mx-auto mt-10 px-4">
        <h2 class="text-xl font-semibold text-green-700 mb-6">Lista de productos</h2>

        @if($productos->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($productos as $producto)
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4">
                        @if($producto->imagen)
                            <img src="{{ asset('storage/'.$producto->imagen) }}" 
                                 class="w-full h-48 object-cover rounded-lg mb-3" 
                                 alt="Imagen de {{ $producto->nombre }}">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded-lg mb-3">
                                <span class="text-gray-500">Sin imagen</span>
                            </div>
                        @endif

                        <h3 class="text-lg font-bold text-gray-800">{{ $producto->nombre }}</h3>
                        <p class="text-gray-600 text-sm mb-2">{{ $producto->descripcion ?? 'Sin descripción' }}</p>
                        <p class="text-green-700 font-semibold mb-4">$ {{ number_format($producto->precio, 2) }}</p>

                        <div class="flex justify-between">
                            <a href="{{ route('productos.edit', $producto) }}" 
                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">Editar</a>

                            <form action="{{ route('productos.destroy', $producto) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500 mt-10">No hay productos registrados aún.</p>
        @endif
    </main>

</body>
</html>
