<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de validação de e-mail</title>
</head>
<body>
    <h1>Teste de validação de e-mail</h1>
    
    <form action="{{ url('/emailcadastro') }}" method="post">
        @csrf
        <input type="text" name="email" placeholder="Digite o e-mail">
        <button type="submit">Enviar</button>
    </form>

    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif
</body>
</html>
