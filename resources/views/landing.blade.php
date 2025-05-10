<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Concurso - Landing Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #1f2937;
            --accent: #2563eb;
            --light: #f3f4f6;
            --success: #16a34a;
            --error: #dc2626;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--light);
            margin: 0;
            padding: 20px;
            color: var(--primary);
        }

        h1, h2 {
            color: var(--primary);
            text-align: center;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-bottom: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form label,
        form input,
        form select,
        form button {
            width: 100%;
            max-width: 400px;
        }

        label {
            margin-top: 10px;
            display: block;
            font-weight: bold;
        }

        input, select {
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        button {
            background-color: var(--accent);
            color: white;
            padding: 10px 20px;
            margin: 5px 0;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #1d4ed8;
        }

        .error, .success {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 6px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .error {
            background-color: #fee2e2;
            color: var(--error);
        }

        .success {
            background-color: #dcfce7;
            color: var(--success);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: var(--accent);
            color: white;
        }

        .actions {
            margin-top: 20px;
            text-align: center;
        }

        .winner-box {
            background: #fef3c7;
            border-left: 6px solid #facc15;
            padding: 15px;
            margin-top: 20px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1><i class="fas fa-car-side"></i> Registro Concurso Automóviles</h1>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ old('nombre') }}" required>

        <label>Apellido:</label>
        <input type="text" name="apellido" value="{{ old('apellido') }}" required>

        <label>Cédula:</label>
        <input type="text" name="cedula" value="{{ old('cedula') }}" required>

        <label>Departamento:</label>
        <select name="departamento" required>
            <option value="">Seleccione...</option>
            <option value="Cundinamarca">Cundinamarca</option>
            <option value="Antioquia">Antioquia</option>
            <option value="Valle del Cauca">Valle del Cauca</option>
        </select>

        <label>Ciudad:</label>
        <select name="ciudad" required>
            <option value="">Seleccione...</option>
            <option value="Bogotá">Bogotá</option>
            <option value="Medellín">Medellín</option>
            <option value="Cali">Cali</option>
        </select>

        <label>Celular:</label>
        <input type="text" name="celular" value="{{ old('celular') }}" required>

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>
            <input type="checkbox" name="habeas_data" value="1" required>
            Autorizo el tratamiento de mis datos de acuerdo con la política de protección de datos personales.
        </label>

        <button type="submit">Registrar</button>
    </form>

    <div class="actions">
        <a href="{{ route('export') }}">
            <button>📥 Exportar a Excel</button>
        </a>

        <a href="{{ route('winner') }}">
            <button>🎲 Seleccionar Ganador</button>
        </a>
    </div>

    @if(isset($winner))
        <div class="winner-box">
            <h2>🎉 Ganador Seleccionado</h2>
            <p><strong>{{ $winner->nombre }} {{ $winner->apellido }}</strong><br>
               Email: {{ $winner->email }}</p>
        </div>
    @endif

    <h2>Participantes Registrados</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cédula</th>
                <th>Departamento</th>
                <th>Ciudad</th>
                <th>Celular</th>
                <th>Email</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($participants as $p)
                <tr>
                    <td>{{ $p->nombre }}</td>
                    <td>{{ $p->apellido }}</td>
                    <td>{{ $p->cedula }}</td>
                    <td>{{ $p->departamento }}</td>
                    <td>{{ $p->ciudad }}</td>
                    <td>{{ $p->celular }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
