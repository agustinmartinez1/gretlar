<!DOCTYPE html>
<html>
<head>
    <title>ChatGPT Example</title>
</head>
<body>
    <h1>ChatGPT Example</h1>

    <form method="POST" action="{{ route('buscar-recurso') }}">
        @csrf
        <input type="text" name="descripcion_recurso" placeholder="Introduce la descripción del recurso">
        <button type="submit">Buscar Recurso</button>
    </form>
</body>
</html>
