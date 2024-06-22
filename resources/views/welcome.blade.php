<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Leyendo Horizontes</title>
    <style>
        body {
            font-family: 'Cambria', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .nav-bar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            background-color: #343a40;
            padding: 1em 2em;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .nav-bar a {
            text-decoration: none;
            color: white;
            margin-left: 1em;
            font-size: 1.1em;
            transition: color 0.3s;
            font-family: 'Cambria', serif;
        }
        .nav-bar a:hover {
            color: #17a2b8;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 2em 1em;
        }
        h1 {
            font-size: 3em; 
            margin-bottom: 0.5em;
            color: #343a40;
            text-align: center;
            font-family: 'Cambria', serif;
        }
        h2 {
            font-size: 2.5em; 
            margin-bottom: 1em;
            color: #343a40;
            text-align: center;
            font-family: 'Cambria', serif;
        }
        .form-container {
            margin-bottom: 2em;
            text-align: center;
        }
        form {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 1em;
        }
        input[type="text"] {
            padding: 0.75em;
            font-size: 1em;
            border: 1px solid #ced4da;
            border-radius: 20px;
            width: 70%;
            font-family: 'Cambria', serif;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        button[type="submit"], .back-button, .alquilar-button {
            padding: 0.75em 1.5em;
            font-size: 1em;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
            margin-left: 0.5em;
            text-decoration: none;
            font-family: 'Cambria', serif;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        button[type="submit"]:hover, .back-button:hover, .alquilar-button:hover {
            background-color: #0056b3;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
            
        }
        
        .back-button {
            display: inline-block;
            margin-top: 1em; 
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5em;
        }
        .grid-item {
            background-color: white;
            padding: 1.5em;
            border: 1px solid #ced4da;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .grid-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .grid-item h2 {
            margin: 0 0 0.5em;
            font-size: 1.5em;
            color: #343a40;
            font-family: 'Cambria', serif;
        }
        .grid-item p {
            margin: 0.5em 0;
            color: #6c757d;
            font-family: 'Cambria', serif;
        }
        .disponible {
            font-weight: bold;
            color: green !important; 
        }
        .no-disponible {
            font-weight: bold;
            color: red !important;
        }
    </style>
</head>
<body>
    <div class="nav-bar">
        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ url('/dashboard') }}">Cuenta</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

    <div class="container">
        <h1>Biblioteca "Leyendo Horizontes"</h1>
        <h2>Lista de Libros</h2>
        <div class="form-container">
            <form action="{{ route('welcome') }}" method="GET">
                <input type="text" name="query" placeholder="Buscar libros..." value="{{ request('query') }}">
                <button type="submit">Buscar</button>
            </form>
            @auth
                <form action="{{ route('dashboard') }}" method="GET">
                    <button type="submit" class="alquilar-button">Alquilar Libro</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="alquilar-button">Alquilar Libro</a>
            @endauth
            @if (request('query'))
                <a href="{{ route('welcome') }}" class="back-button">Volver al Listado</a>
            @endif
        </div>

        <div class="grid-container">
            @foreach ($libros as $libro)
                <div class="grid-item">
                    <h2>{{ $libro->nombre_libro }}</h2>
                    <p><strong>Autor:</strong> {{ $libro->autor }}</p>
                    <p><strong>Año:</strong> {{ $libro->año }}</p>
                    <p><strong>Editorial:</strong> {{ $libro->editorial }}</p>
                    <p><strong>Género:</strong> {{ $libro->genero }}</p>
                    <p class="{{ $libro->disponible ? 'disponible' : 'no-disponible' }}">
                        {{ $libro->disponible ? 'Disponible' : 'Reservado' }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>


