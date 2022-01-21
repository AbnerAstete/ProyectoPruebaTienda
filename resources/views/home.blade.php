<!DOCTYPE html>
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
    
    <video src="{{asset('video/home/video1.mp4') }}" muted loop autoplay></video>
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
            <li><a href="{{URL('productos')}}">Productos</a></li>

            @if(Auth::check())
                @if(Auth::user()->id_tipo_usuario == 1)
                    <li><a href="{{URL('/ingresado/logout')}}">Salir</a></li>
                    <br>USUARIO: {{Auth::user()->rut}}
                    <br>NOMBRE: {{Auth::user()->nombre}}  {{Auth::user()->apellido}} 
                @endif
                @if(Auth::user()->id_tipo_usuario == 2)
                    <li><a href="{{URL('mostrarUsuarios')}}">Lista Usuarios</a></li>
                    <li><a href="{{URL('agregarProducto')}}">Agregar Productos</a></li>
                    <li><a href="{{URL('mostrarProducto')}}">Lista Productos</a></li>
                    <li><a href="{{URL('/ingresado/logout')}}">Salir</a></li>
                    <br>USUARIO: {{Auth::user()->rut}}
                    <br>NOMBRE: {{Auth::user()->nombre}}  {{Auth::user()->apellido}} 
                @endif
            @endif
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
</html>
