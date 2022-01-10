<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
</head>
<body>
    
    <a href="{{URL('/registrar')}}"><input type="button" value="Ir"></a>
    
    @if(Auth::check())
        <a href="{{URL('/salir')}}"><input type="button" value="Salir"></a>
        {{Auth::user()->rut}}
    @endif

</body>
</html>