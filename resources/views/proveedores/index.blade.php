<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Proveedores</title>
    <!-- Usamos Tailwind CSS para la coherencia del diseño -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        .modal {
            background-color: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-4xl bg-white shadow-xl rounded-2xl">
        <div class="mb-6 text-center">
            <h1 class="text-3xl font-bold text-gray-800">Gestión de Proveedores</h1>
            <p class="text-gray-500 mt-2">
                Añade, edita y elimina proveedores de tu base de datos contable.
            </p>
        </div>

        <!-- Mensajes de éxito o error -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Formulario para agregar/editar un proveedor -->
        <div class="bg-gray-100 p-6 rounded-xl shadow-inner mb-8">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Añadir Nuevo Proveedor</h2>
            <form action="{{ route('proveedores.store') }}" method="POST">
                @csrf
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre del Proveedor</label>
                        <input type="text" id="nombre" name="nombre" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ej: Distribuidora Eléctrica" required>
                    </div>
                    <div>
                        <label for="contacto" class="block text-sm font-medium text-gray-700 mb-1">Nombre del Contacto</label>
                        <input type="text" id="contacto" name="contacto" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ej: Juan Pérez">
                    </div>
                    <div>
                        <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                        <input type="text" id="telefono" name="telefono" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ej: 55-5555-5555">
                    </div>
                    <div>
                        <label for="direccion" class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                        <input type="text" id="direccion" name="direccion" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ej: Calle Principal 123">
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition-colors">Guardar Proveedor</button>
                </div>
            </form>
        </div>

        <!-- Lista de proveedores -->
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Lista de Proveedores</h2>
        <div class="space-y-4">
            @foreach ($proveedores as $proveedor)
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between transition-shadow hover:shadow-md">
                    <div class="mb-2 sm:mb-0">
                        <p class="font-semibold text-gray-800">{{ $proveedor->nombre }}</p>
                        <p class="text-sm text-gray-500">Contacto: {{ $proveedor->contacto }}</p>
                        <p class="text-sm text-gray-500">Teléfono: {{ $proveedor->telefono }}</p>
                        <p class="text-sm text-gray-500">Dirección: {{ $proveedor->direccion }}</p>
                    </div>
                    <div class="flex space-x-2 mt-2 sm:mt-0">
                        <!-- Botón de Editar -->
                        <a href="{{ route('proveedores.edit', ['proveedor' => $proveedor->id]) }}" class="bg-yellow-400 text-gray-800 font-medium py-1 px-3 rounded-md hover:bg-yellow-500 transition-colors">Editar</a>
                        <!-- Botón de Eliminar -->
                        <form action="{{ route('proveedores.destroy', ['proveedor' => $proveedor->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white font-medium py-1 px-3 rounded-md hover:bg-red-600 transition-colors" onclick="return confirm('¿Estás seguro de que quieres eliminar a este proveedor?');">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
            @if ($proveedores->isEmpty())
                <p class="text-center text-gray-500">No hay proveedores registrados.</p>
            @endif
        </div>
    </div>
</body>
</html>
