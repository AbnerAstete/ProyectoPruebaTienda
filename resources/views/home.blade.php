@extends('plantilla')

@section('seccion')

    <br><a href="{{URL('/registrar')}}"><input type="button" value="Log In"></a><br>
    <br><a href="{{URL('mostrarUsuarios')}}"><input type="button" value="Ver Lista Usuarios"></a><br>
    <br><a href="{{URL('agregarProducto')}}"><input type="button" value="Agregar Productos"></a><br>
    <br><a href="{{URL('mostrarProducto')}}"><input type="button" value="Ver Lista Productos"></a><br>
    {{csrf_field()}}
    @if(Auth::check())
        <br><a href="{{URL('/ingresado/logout')}}"><input type="button" value="Salir"></a><br>
        <br>USUARIO: {{Auth::user()->rut}}<br>
    @endif

@endsection

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/home.css') }}">
    <title>Home</title>
</head>
<body>
    <section class="showcase">
        <header>
            <h2 class="logo">Travel</h2>
            <div class="toggle"></div>
        </header>
    
    <video src="{{asset('video/home/video3.mp4') }}" muted loop autoplay></video>
    <div class="overlay"></div>
    <div class="text">
        <h2>No Te Detengas</h2>
        <h3>Imagine un texto</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab placeat dicta sequi expedita voluptatum repellendus quidem
             quisquam deleniti modi, rerum quaerat magnam corrupti debitis, atque exercitationem soluta neque ut enim.</p>
        <a href="#">Explora</a>
    </div>

    <ul class="social">
        <li><a href="#"><img src="{{asset('img/home/facebook.png') }}" alt=""></a></li>
        <li><a href="#"><img src="{{asset('img/home/twitter.png') }}" alt=""></a></li>
        <li><a href="#"><img src="{{asset('img/home/instagram.png') }}" alt=""></a></li>
    </ul>
    </section>
    <div class="menu">
        <ul>
            <li><a href="{{URL('/registrar')}}">Login</a></li>
            <li><a href="#">Productos</a></li>  
        </ul>
    </div>
    <script>
        const menuToggle =document.querySelector('.toggle')
        const showcase =document.querySelector('.showcase')  
        menuToggle.addEventListener('click', () => {
            menuToggle.classList.toggle('active');
            showcase.classList.toggle('active');
        })
    </script>
</body>
</html> --}}
