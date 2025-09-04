<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Asiento Contable</title>
    <!-- Usamos Tailwind CSS para la coherencia del diseño -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-2xl bg-white shadow-xl rounded-2xl">
        <div class="mb-6 text-center">
            <h1 class="text-3xl font-bold text-gray-800">Editar Asiento Contable</h1>
            <p class="text-gray-500 mt-2">
                Modifica los datos del asiento contable seleccionado.
            </p>
        </div>

        <!-- Mensajes de error de validación -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">Por favor, corrige los siguientes errores:</span>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario para editar un asiento -->
        <div class="bg-gray-100 p-6 rounded-xl shadow-inner mb-8">
            <form action="{{ route('asientos.update', $asiento->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                        <input type="date" id="fecha" name="fecha" value="{{ old('fecha', $asiento->fecha) }}" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea id="descripcion" name="descripcion" rows="3" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('descripcion', $asiento->descripcion) }}</textarea>
                    </div>
                    <div>
                        <label for="monto_debe" class="block text-sm font-medium text-gray-700 mb-1">Monto (Debe)</label>
                        <input type="number" step="0.01" id="monto_debe" name="monto_debe" value="{{ old('monto_debe', $asiento->monto_debe) }}" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="monto_haber" class="block text-sm font-medium text-gray-700 mb-1">Monto (Haber)</label>
                        <input type="number" step="0.01" id="monto_haber" name="monto_haber" value="{{ old('monto_haber', $asiento->monto_haber) }}" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="cuenta_debe" class="block text-sm font-medium text-gray-700 mb-1">Cuenta (Debe)</label>
                        <input type="text" id="cuenta_debe" name="cuenta_debe" value="{{ old('cuenta_debe', $asiento->cuenta_debe) }}" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label for="cuenta_haber" class="block text-sm font-medium text-gray-700 mb-1">Cuenta (Haber)</label>
                        <input type="text" id="cuenta_haber" name="cuenta_haber" value="{{ old('cuenta_haber', $asiento->cuenta_haber) }}" class="w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-2">
                    <a href="{{ route('asientos.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition-colors">Cancelar</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition-colors">Actualizar Asiento</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
