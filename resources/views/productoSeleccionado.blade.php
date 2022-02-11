@extends('plantilla')

{{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script> --}}
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<link rel="stylesheet" href="{{asset('css/productoSeleccionado.css') }}">
<script type="text/javascript" src="{{asset('js/productoSeleccionado.js') }}"> </script>
@section('seccion')
	
	<div class="carrito"> 
		@if(Auth::check())
			<a  onclick="carrito()" id="carrito" type="button" class=" carrito btn btn-dark">Carrito({{count($compraCliente)}})</a>
		{{-- @else
			<a  href="{{URL('/registrar')}}" type="button" class="carrito btn btn-dark">Carrito</a> --}}
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

			<form   id = "cantidadSeleccionada"  method="post" >
				<input name="id_producto" id='id_producto' type="hidden" value={{$producto->id_producto}}>
				<input name="stock_producto" id='stock_producto' type="hidden" value={{$producto->stock_producto}}>
				{{csrf_field()}}

				<label>Cantidad:</label>
				<div >
					<p class="text-danger mb-2 d-none" id="alertCantidad"></p>
					<input class=" boton-carrito cantidadProducto form-control" id='cantidadProducto' type="number" name="cantidad_productos"  value="1" /><br>
				
					@if(Auth::check())
						<button  type="submit" id="cantidadSeleccionada-submit"  class=" boton-carrito btn btn-dark">Agregar al Carrito</button><br>
					@else
						<a  href="{{URL('/registrar')}}" type="button" class="boton-carrito btn btn-dark">Agregar al Carrito</a>
					@endif
				</div>
				<div class="alert alert-success mt-2 d-none" id="alertSuccess"></div>
			</form>

			<br><a  href="{{URL('productos')}}" type="button" class=" boton-carrito btn btn-dark">Ver mas productos</a>
			<img class="tallas" src="{{asset('img/tallasPolera.jpg') }}" alt="">
		</div>
	</div>


@endsection