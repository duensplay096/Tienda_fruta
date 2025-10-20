<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Tienda de Frutas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-green-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-md w-96">
        <h1 class="text-2xl font-bold text-center mb-6">Iniciar Sesión 🍊</h1>
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-2 font-semibold">Usuario</label>
                <input type="text" name="usuario" class="w-full border rounded p-2" required>
            </div>
            <div class="mb-4">
                <label class="block mb-2 font-semibold">Contraseña</label>
                <input type="password" name="password" class="w-full border rounded p-2" required>
            </div>
            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
                Entrar
            </button>
        </form>
        @if (session('error'))
            <p class="text-red-500 text-center mt-4">{{ session('error') }}</p>
        @endif
    </div>
</body>
</html>
