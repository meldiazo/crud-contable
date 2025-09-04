<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-2xl bg-white shadow-xl rounded-2xl">
        <div class="mb-6 text-center">
            <h1 class="text-3xl font-bold text-gray-800">Crear Producto</h1>
        </div>
        <div class="bg-gray-100 p-6 rounded-xl shadow-inner mb-8">
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
                <div class="mt-6 flex justify-end space-x-2">
                    <a href="{{ route('productos.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-6 rounded-lg">Cancelar</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>


