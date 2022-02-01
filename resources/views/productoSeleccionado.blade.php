@extends('plantilla')
<link rel="stylesheet" href="{{asset('css/productoSeleccionado.css') }}">
<script type="text/javascript" src="{{asset('js/productoSeleccionado.js') }}"> </script>
@section('seccion')
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

			{{-- form? --}}
			<label>Cantidad:</label>
			<div >
				<input class=" carrito cantidadProducto form-control" type="number" name="cantidadProducto" min="0" max="{{$producto->stock_producto}}" value="1" /><br>
				@if(Auth::check())
					<a  href="{{URL('carrito')}}" type="button" class=" carrito btn btn-dark">Agregar al Carrito</a>
				@else
					<a  href="{{URL('/registrar')}}" type="button" class="carrito btn btn-dark">Agregar al Carrito</a>
				@endif
			</div>
			

			<img class="tallas" src="{{asset('img/tallasPolera.jpg') }}" alt="">
		</div>
	</div>


@endsection