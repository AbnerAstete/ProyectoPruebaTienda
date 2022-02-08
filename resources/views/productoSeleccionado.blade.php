@extends('plantilla')
<link rel="stylesheet" href="{{asset('css/productoSeleccionado.css') }}">
<script type="text/javascript" src="{{asset('js/productoSeleccionado.js') }}"> </script>
@section('seccion')
	
	<div class="carrito">
		@if(Auth::check())
        	<a  href="{{URL('carrito')}}" type="button" class=" carrito btn btn-dark">Carrito({{count($compraCliente)}})</a>
    	@else
        	<a  href="{{URL('/registrar')}}" type="button" class="carrito btn btn-dark">Carrito</a>
    	@endif
	</div>
	
	<h1 class="encabezado">PRODUCTO: {{$producto->nombre_producto}}</h1>
	
	<div class="row justify-content-center">
		<div class="col-4">
			<img class="imagen" src="{{ asset('imagenes/'.$producto->imagen) }}"><br>
		</div>
		<div class="col-4">
			<label class="nombre">{{$producto->nombre_producto}}</label><br>
			$ {{$producto->precio_producto}}<br>
			Talla: {{$producto->talla_producto}}<br>
			Stock Disponible: {{$producto->stock_producto}}<br>

			<form   id = "cantidadSeleccionada"  method="post" action="{{URL('agregarAlCarrito')}}">
				<input name="id_producto" type="hidden" value={{$producto->id_producto}}>
				{{csrf_field()}}

				<label>Cantidad:</label>
				<div >
					<input class=" boton-carrito cantidadProducto form-control" type="number" name="cantidad_productos" min="0" max="{{$producto->stock_producto}}" value="0" /><br>
					
					
					@if(Auth::check())
						<button  type="submit"  class=" boton-carrito btn btn-dark">Agregar al Carrito</button><br>
					@else
						<a  href="{{URL('/registrar')}}" type="button" class="boton-carrito btn btn-dark">Agregar al Carrito</a>
					@endif
				</div>
			</form>

			<br><a  href="{{URL('productos')}}" type="button" class=" boton-carrito btn btn-dark">Ver mas productos</a>
			<img class="tallas" src="{{asset('img/tallasPolera.jpg') }}" alt="">
		</div>
	</div>


@endsection