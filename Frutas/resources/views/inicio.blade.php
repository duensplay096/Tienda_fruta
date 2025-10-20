<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tienda de Frutas</title>
 <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50">
  <header class="bg-green-600 text-white p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold">Tienda de Frutas</h1>
    <a href="{{ route('productos.form') }}" class="bg-white text-green-600 px-4 py-2 rounded">Agregar producto</a>
  </header>
  <main class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($productos as $producto)
      <div class="bg-white p-4 rounded-lg shadow">
        @if($producto->imagen)
          <img src="{{ asset('storage/'.$producto->imagen) }}" class="rounded mb-2 h-40 w-full object-cover">
        @endif
        <h2 class="text-lg font-bold">{{ $producto->nombre }}</h2>
        <p class="text-gray-600">{{ $producto->descripcion }}</p>
        <p class="font-semibold text-green-600">$ {{ $producto->precio }}</p>
        <div class="mt-3 flex justify-between">
          <a href="{{ route('productos.edit', $producto) }}" class="text-blue-600">Editar</a>
          <form action="{{ route('productos.destroy', $producto) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="text-red-600">Eliminar</button>
          </form>
        </div>
      </div>
    @endforeach
  </main>
</body>
</html>
