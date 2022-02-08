@extends('plantilla')

@section('seccion')

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="{{asset('js/updateproducto.js') }}"> </script> 
<script type="text/javascript" src="{{asset('js/imagen.js') }}"> </script> 
<link rel="stylesheet" href="{{asset('css/imagen.css') }}">

<br><a href="{{URL('mostrarProducto')}}"><input type="button" value="Ver Lista Productos"></a><br>
    

	<h1 class="text-center">Editar Producto</h1><br>


<div class="container" >
	<div class="row">



		<div class="col-8"> 
			<form   id = "formulario_producto" enctype ="multipart/form-data"  method="POST">
	
				{{-- {{method_field('PUT')}} --}}
				{{csrf_field()}}
	
				<input type="hidden" name ="id_productox"  id ="id_productox" value="{{$producto->id_producto}}">
	
	
				<input type="text" name="nombre_producto" id="nombre_producto"autocomplete="off"  enctype ="multipart/form-data"placeholder="Nombre" class="form-control mb-2" value="{{$producto->nombre_producto}}"/>
				<p class="text-danger mb-2 d-none" id="alert_nombre_producto"></p>
	
				<input type="text" name="precio_producto"  id= "precio_producto"  placeholder="Precio" class="form-control mb-2" value="{{$producto->precio_producto}}"/>
				<p class="text-danger mb-2 d-none" id="alert_precio_producto"></p>
	
				<div class="form-group">
					<label for="talla_producto">Talla: </label>
					<select class="form-control" name="talla_producto">
					<option>S</option>
					<option>M</option>
					<option>L</option>
					<option>XL</option>
					<option>XXL</option>
					</select></div>
				@if($producto->disponibilidad_producto)
				<input type="radio" name="disponibilidad_producto" value = 'True' checked /> Disponible
				<input type="radio" name="disponibilidad_producto" value = 'False' /> No Disponible
				@else
				<input type="radio" name="disponibilidad_producto" value = 'True' /> Disponible
				<input type="radio" name="disponibilidad_producto" value = 'False' checked /> No Disponible
				@endif
				
				<input type="text" name="stock_producto" id= "stock_producto" placeholder="Stock" class="form-control mb-2" value="{{$producto->stock_producto}}"/>
				<p class="text-danger mb-2 d-none" id="alert_stock_producto"></p>
	
				<textarea name="descripcion_producto" id= "descripcion_producto" rows="4" cols="10" placeholder="Ingrese descripcion del producto" class="form-control mb-2" value="" >{{$producto->descripcion}}</textarea>
				<p class="text-danger mb-2 d-none" id="alert_descripcion_producto"></p>
	
	
	
				<input type="file" name="ruta" id="file" placeholder="Imagen"  onchange = 'previewImage(this)' class="form-control mb-2"/> <br>
				{{-- <img id="blah" src="https://via.placeholder.com/150" alt="Tu imagen"  /> --}}

				@foreach ($categorias as $item)
						
					
           				 <td><input type="checkbox" id="categorias" name="categorias[]"   value="{{$item->id_categoria}}" {{ $producto->categorias->contains($item) ? 'checked' : '' }}>{{$item->nombre_categoria}}</td>


							{{-- <input type="checkbox"  value="{{$item->id_categoria}}">{{$item->nombre_categoria}} --}}
			   @endforeach
			 
	
				<button class="btn btn-warning btn-block" type="submit" id = "editar-submit">Editar</button>
				<div class="alert alert-succes my2 d-none" id ="alertSuccess"></div>
	
			</form>

		</div>



		<div  class="col-4"> <h2> Nombre: {{$producto->nombre_producto}} </h2>
			@if($producto->imagen)

			 <img src="{{ asset('imagenes/'.$producto->imagen) }}"  width='300'> 
			@else
			 <img src="{{ asset('imagenes/default.jpg') }}"  width='300'> 
			@endif 	
		</div>
	  

	
	
	



	</div>
</div>




@endsection