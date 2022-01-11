<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{URL('/registrar')}}"><input type="button" value="Ir"></a>
    
    @if(Auth::check())
        <a href="{{URL('/logout')}}"><input type="button" value="Salir"></a>
        {{Auth::user()->rut}}
    @endif
    
</body>
</html>