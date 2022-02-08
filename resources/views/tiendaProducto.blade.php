@extends('plantilla')

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="{{asset('css/tiendaProducto.css') }}">
<script type="text/javascript" src="{{asset('js/tiendaProducto.js') }}"> </script>
@section('seccion')

    <a  href="{{URL('')}}" type="button" class=" home btn btn-dark">Home</a>
    <div class="carrito"> 
        @if(Auth::check())
            <a  onclick="carrito()" id="carrito" type="button" class=" carrito btn btn-dark">Carrito({{count($compraCliente)}})</a>
        {{-- @else
            <a  href="{{URL('/registrar')}}" type="button" class="carrito btn btn-dark">Carrito</a> --}}
        @endif
    </div>

	<h1 class="encabezado">PRODUCTOS</h1><br>
    
    
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
    
      


@endsection