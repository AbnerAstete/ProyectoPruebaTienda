@extends('plantilla')
<link rel="stylesheet" href="{{asset('css/tiendaProducto.css') }}">
<script type="text/javascript" src="{{asset('js/tiendaProducto.js') }}"> </script>
@section('seccion')
	<h1 class="encabezado">PRODUCTOS</h1>

    <br>
    
    
    <div class="row">
        @foreach ($productos as $item)
        @if ($item->disponibilidad_producto) 
        <div class="col">
            <div class="card" style="width: 20rem; border: 1px solid rgba(0,0,0,0);">
                <a href="{{URL('productoSeleccionado',$item->id_producto)}}"><img class="card-img-top" id="imagen{{$item->id_producto }}" src="{{ asset('imagenes/'.$item->imagen) }}" alt="Card image cap" onmouseover = "changePic1({{$item->id_producto }})"onmouseout= "changePic2({{$item->id_producto }})"></a>
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