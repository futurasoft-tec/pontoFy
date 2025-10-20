<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Painel Super Administrador</title>
</head>

<body>
    <h1>Dashboard do Administrador do Sistema</h1>
    <p>Bem-vindo, {{ Auth::user()->name }}!</p>


    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Terminar Sessão</button>
    </form>

</body>

</html>
