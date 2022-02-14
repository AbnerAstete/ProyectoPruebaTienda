@extends('plantilla')
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="{{asset('css/productoSeleccionado.css') }}">
<script type="text/javascript" src="{{asset('js/productoSeleccionado.js') }}"> </script>
@section('seccion')
	

<section class="showcase" >
	<header>
		</h1><a> PRODUCTO: {{$producto->nombre_producto}}</a>  
		<div class="toggle"></div>
	</header>
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
</section>

	<div class="menu">
		<ul>
			
			@if(Auth::check())
				@if(Auth::user()->id_tipo_usuario == 1)
				<li><a  onclick="carrito()" id="carrito" type="button" class= "carrito" >Carrito({{count($compraCliente)}})</a></li>
				@endif
				@if(Auth::user()->id_tipo_usuario == 2)
					<li><a  onclick="carrito()" id="carrito" type="button" class= "carrito" >Carrito({{count($compraCliente)}})</a></li>
				@endif
			@endif
			<li><a  href="{{URL('')}}" type="button" class= "home">Home</a></li>
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