<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Asiento</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: auto; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #333; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; color: #555; font-weight: bold; }
        input[type="text"], input[type="date"], input[type="number"], textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Ensures padding doesn't affect the final width */
        }
        .btn { padding: 10px 15px; border: none; cursor: pointer; text-decoration: none; border-radius: 4px; color: white; display: inline-block; }
        .btn-primary { background-color: #007bff; }
        .btn-secondary { background-color: #6c757d; }
        .btn-container { display: flex; justify-content: space-between; margin-top: 20px; }
        .alert-danger { background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 20px; }
        .alert-danger ul { margin: 0; padding-left: 20px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Crear Nuevo Asiento Contable</h2>

    @if ($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('asientos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" value="{{ old('fecha') }}" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion') }}</textarea>
        </div>
        <div class="form-group">
            <label for="monto_debe">Monto (Debe)</label>
            <input type="number" step="0.01" id="monto_debe" name="monto_debe" value="{{ old('monto_debe') }}" required>
        </div>
        <div class="form-group">
            <label for="monto_haber">Monto (Haber)</label>
            <input type="number" step="0.01" id="monto_haber" name="monto_haber" value="{{ old('monto_haber') }}" required>
        </div>
        <div class="form-group">
            <label for="cuenta_debe">Cuenta (Debe)</label>
            <input type="text" id="cuenta_debe" name="cuenta_debe" value="{{ old('cuenta_debe') }}" required>
        </div>
        <div class="form-group">
            <label for="cuenta_haber">Cuenta (Haber)</label>
            <input type="text" id="cuenta_haber" name="cuenta_haber" value="{{ old('cuenta_haber') }}" required>
        </div>
        <div class="btn-container">
            <a href="{{ route('asientos.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar Asiento</button>
        </div>
    </form>
</div>

</body>
</html>
