<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>create pull funds</p>
    <form action="{{route('createPullFunds')}}" method="POST">
        @csrf
        <input type="text" name="tarjeta" placeholder="tarjeta">
        <input type="text" name="nombre_tt" placeholder="nombre_tt">
        <input type="text" name="fecha_vencimiento" placeholder="fecha_vencimiento">
        <input type="text" name="ccv" placeholder="ccv">
        <input type="text" name="direccion" placeholder="direccion">
        <input type="text" name="monto" placeholder="monto">
        <input type="text" name="destinatario" placeholder="destinatario">
        <input type="submit" placeholder="enviar">
    </form>
    <p>read pull funds</p>
    <form action="{{route('readPullFunds')}}" method="POST">
        @csrf
        <input type="text" name="tarjeta" placeholder="tarjeta">
        <input type="text" name="nombre_tt" placeholder="nombre_tt">
        <input type="text" name="fecha_vencimiento" placeholder="fecha_vencimiento">
        <input type="text" name="ccv" placeholder="ccv">
        <input type="text" name="direccion" placeholder="direccion">
        <input type="text" name="monto" placeholder="monto">
        <input type="text" name="destinatario" placeholder="destinatario">
        <input type="submit" placeholder="enviar">
    </form>
</body>
</html>