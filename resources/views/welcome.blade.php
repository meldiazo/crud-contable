<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD CONTABLE</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Inter font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; /* igual que tu otra vista */
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-2xl bg-white shadow-xl rounded-2xl">
        <div class="mb-6 text-center">
            <h1 class="text-3xl font-bold text-gray-800">CRUD CONTABLE</h1>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <a href="{{ route('asientos.index') }}"
               class="inline-flex items-center justify-center w-full py-3 px-6 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition-colors">
                Asientos
            </a>

            <a href="{{ route('proveedores.index') }}"
               class="inline-flex items-center justify-center w-full py-3 px-6 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg shadow-md transition-colors">
                Proveedores
            </a>

            <a href="{{ route('clientes.index') }}"
               class="inline-flex items-center justify-center w-full py-3 px-6 bg-amber-600 hover:bg-amber-700 text-white font-semibold rounded-lg shadow-md transition-colors">
                Clientes
            </a>

            <a href="{{ route('productos.index') }}"
               class="inline-flex items-center justify-center w-full py-3 px-6 bg-fuchsia-600 hover:bg-fuchsia-700 text-white font-semibold rounded-lg shadow-md transition-colors">
                Productos
            </a>
        </div>
    </div>
</body>
</html>
