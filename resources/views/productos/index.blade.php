<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-4xl bg-white shadow-xl rounded-2xl">
        <div class="mb-4 flex justify-end">
            <a href="{{ url('/') }}" class="px-4 py-2 rounded-md bg-gray-200 hover:bg-gray-300 text-gray-800">Home</a>
        </div>
        <div class="mb-6 text-center">
            <h1 class="text-3xl font-bold text-gray-800">Gestión de Productos</h1>
            <p class="text-gray-500 mt-2">Añade, edita y elimina productos.</p>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-gray-100 p-6 rounded-xl shadow-inner mb-8">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Añadir Nuevo Producto</h2>
            <form action="{{ route('productos.store') }}" method="POST">
                @csrf
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input type="text" name="nombre" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Precio</label>
                        <input type="number" step="0.01" name="precio" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea name="descripcion" class="w-full p-2 border border-gray-300 rounded-lg"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                        <input type="number" name="stock" class="w-full p-2 border border-gray-300 rounded-lg" required>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md">Guardar Producto</button>
                </div>
            </form>
        </div>

        <h2 class="text-xl font-semibold mb-4 text-gray-700">Lista de Productos</h2>
        <div class="space-y-4">
            @foreach ($productos as $producto)
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between">
                    <div class="mb-2 sm:mb-0">
                        <p class="font-semibold text-gray-800">{{ $producto->nombre }}</p>
                        <p class="text-sm text-gray-500">Precio: ${{ number_format($producto->precio, 2) }}</p>
                        <p class="text-sm text-gray-500">Stock: {{ $producto->stock }}</p>
                        <p class="text-sm text-gray-500">{{ $producto->descripcion }}</p>
                    </div>
                    <div class="flex space-x-2 mt-2 sm:mt-0">
                        <a href="{{ route('productos.edit', ['producto' => $producto->id]) }}" class="bg-yellow-400 text-gray-800 font-medium py-1 px-3 rounded-md hover:bg-yellow-500">Editar</a>
                        <form action="{{ route('productos.destroy', ['producto' => $producto->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white font-medium py-1 px-3 rounded-md hover:bg-red-600" onclick="return confirm('¿Eliminar este producto?');">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
            @if ($productos->isEmpty())
                <p class="text-center text-gray-500">No hay productos registrados.</p>
            @endif
        </div>
    </div>
</body>
</html>


