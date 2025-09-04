<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Asientos Contables</title>
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
            <h1 class="text-3xl font-bold text-gray-800">Gestión de Asientos Contables</h1>
            <p class="text-gray-500 mt-2">
                Añade, edita y elimina asientos de tu libro mayor.
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

        <!-- Formulario para agregar/editar un asiento -->
        <div class="bg-gray-100 p-6 rounded-xl shadow-inner mb-8">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Añadir Nuevo Asiento</h2>
            <form action="{{ route('asientos.store') }}" method="POST">
                @csrf
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                        <input type="date" id="fecha" name="fecha" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <input type="text" id="descripcion" name="descripcion" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ej: Pago de salario" required>
                    </div>
                    <div>
                        <label for="monto_debe" class="block text-sm font-medium text-gray-700 mb-1">Monto (Debe)</label>
                        <input type="number" step="0.01" id="monto_debe" name="monto_debe" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="monto_haber" class="block text-sm font-medium text-gray-700 mb-1">Monto (Haber)</label>
                        <input type="number" step="0.01" id="monto_haber" name="monto_haber" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="cuenta_debe" class="block text-sm font-medium text-gray-700 mb-1">Cuenta (Debe)</label>
                        <input type="text" id="cuenta_debe" name="cuenta_debe" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ej: Gasto de Salarios" required>
                    </div>
                    <div>
                        <label for="cuenta_haber" class="block text-sm font-medium text-gray-700 mb-1">Cuenta (Haber)</label>
                        <input type="text" id="cuenta_haber" name="cuenta_haber" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ej: Efectivo en Caja" required>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition-colors">Guardar Asiento</button>
                </div>
            </form>
        </div>

        <!-- Lista de asientos -->
        <h2 class="text-xl font-semibold mb-4 text-gray-700">Lista de Asientos</h2>
        <div class="space-y-4">
            @foreach ($asientos as $asiento)
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between transition-shadow hover:shadow-md">
                    <div class="mb-2 sm:mb-0">
                        <p class="font-semibold text-gray-800">Fecha: {{ $asiento->fecha }}</p>
                        <p class="text-sm text-gray-500">Descripción: {{ $asiento->descripcion }}</p>
                        <p class="text-sm text-gray-500">Monto Debe: {{ $asiento->monto_debe }}</p>
                        <p class="text-sm text-gray-500">Monto Haber: {{ $asiento->monto_haber }}</p>
                        <p class="text-sm text-gray-500">Cuenta Debe: {{ $asiento->cuenta_debe }}</p>
                        <p class="text-sm text-gray-500">Cuenta Haber: {{ $asiento->cuenta_haber }}</p>
                    </div>
                    <div class="flex space-x-2 mt-2 sm:mt-0">
                        <!-- Botón de Editar -->
                        <a href="{{ route('asientos.edit', $asiento->id) }}" class="bg-yellow-400 text-gray-800 font-medium py-1 px-3 rounded-md hover:bg-yellow-500 transition-colors">Editar</a>
                        <!-- Botón de Eliminar -->
                        <form action="{{ route('asientos.destroy', $asiento->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white font-medium py-1 px-3 rounded-md hover:bg-red-600 transition-colors" onclick="return confirm('¿Estás seguro de que quieres eliminar este asiento?');">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
            @if ($asientos->isEmpty())
                <p class="text-center text-gray-500">No hay asientos contables registrados.</p>
            @endif
        </div>
    </div>
</body>
</html>
