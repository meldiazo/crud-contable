<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Asientos Contables</title>
    <style>
        body { font-family: sans-serif; }
        .container { max-width: 900px; margin: auto; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 8px 12px; border: none; cursor: pointer; text-decoration: none; border-radius: 4px; color: white; }
        .btn-create { background-color: #4CAF50; }
        .btn-edit { background-color: #008CBA; }
        .btn-delete { background-color: #f44336; }
    </style>
</head>
<body>

<div class="container">
    <h2>Asientos Contables</h2>
    
    <a href="{{ route('asientos.create') }}" class="btn btn-create">Crear Nuevo Asiento</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if($asientos->isEmpty())
        <p>No hay asientos contables registrados.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Descripción</th>
                    <th>Monto (Debe)</th>
                    <th>Monto (Haber)</th>
                    <th>Cuenta (Debe)</th>
                    <th>Cuenta (Haber)</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($asientos as $asiento)
                    <tr>
                        <td>{{ $asiento->fecha }}</td>
                        <td>{{ $asiento->descripcion }}</td>
                        <td>{{ number_format($asiento->monto_debe, 2) }}</td>
                        <td>{{ number_format($asiento->monto_haber, 2) }}</td>
                        <td>{{ $asiento->cuenta_debe }}</td>
                        <td>{{ $asiento->cuenta_haber }}</td>
                        <td>
                            <a href="{{ route('asientos.edit', $asiento->id) }}" class="btn btn-edit">Editar</a>
                            <form action="{{ route('asientos.destroy', $asiento->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete" onclick="return confirm('¿Estás seguro de que quieres eliminar este asiento?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

</body>
</html>