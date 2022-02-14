@extends('plantilla')

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="{{asset('css/tiendaProducto.css') }}">
<script type="text/javascript" src="{{asset('js/tiendaProducto.js') }}"> </script>

@section('seccion')

<section class="showcase">
    <header>
        <a> PRODUCTOS</a>   
        <div class="toggle"></div>
    </header>
    <div class="row">
        @foreach ($productos as $item)
        @if ($item->disponibilidad_producto) 
        <div class="col">
            <div class="card" style="width: 20rem; border: 1px solid rgba(0,0,0,0);">
                <a href="{{URL('productoSeleccionado',$item->id_producto)}}"><img class="card-img-top" id="imagen{{$item->id_producto }}" src="{{ asset('imagenes/'.$item->imagen) }}" alt="Card image cap"></a>
                <div class="card-block">
                    <h4 class="card-title">{{ $item->nombre_producto }}</h4>
                    <p class="card-text">${{ $item->precio_producto }}</p>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</section>

<div class="menu">
    <ul>
        
        @if(Auth::check())
            @if(Auth::user()->id_tipo_usuario == 1)
            <li><a  onclick="carrito()" id="carrito" type="button" class= "carrito" >Carrito({{count($compraCliente)}})</a></li>
            <li><a  href="{{URL('')}}" type="button" class= "home">Home</a></li>
                <br>USUARIO: {{Auth::user()->rut}}
                <br>NOMBRE: {{Auth::user()->nombre}}  {{Auth::user()->apellido}} 
            @endif
            @if(Auth::user()->id_tipo_usuario == 2)
                <li><a  onclick="carrito()" id="carrito" type="button" class= "carrito" >Carrito({{count($compraCliente)}})</a></li>
                <li><a  href="{{URL('')}}" type="button" class= "home">Home</a></li>
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
    
      


@endsection