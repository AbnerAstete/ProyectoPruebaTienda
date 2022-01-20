@extends('plantilla')

@section('seccion')
	<br><a href="{{URL('mostrarProducto')}}"><input type="button" value="Ver Lista Productos"></a><br>
    <h1>Editar nota: {{$producto->id_producto}}</h1> 

    @if (session('mensaje'))
		<div class="alert alert-success">
			{{session('mensaje')}}
		</div>	
	@endif

    <form  action="{{ URL('updateProductos',$producto->id_producto) }}" method="POST">
		{{method_field('PUT')}}
		{{csrf_field()}}


		<input type="text" name="nombre_producto" placeholder="Nombre" class="form-control mb-2" value="{{$producto->nombre_producto}}"/>
		<input type="text" name="precio_producto" placeholder="Precio" class="form-control mb-2" value="{{$producto->precio_producto}}"/>
		<!--input type="text" name="talla_producto"  placeholder="Talla" class="form-control mb-2" value="{{$producto->talla_producto}}"/-->
		
		Talla 
		<select name="talla_producto" >
		<option type="text" name="M">XS</option>
		<option type="text" name="M">S</option>
		<option type="text" name="M">M</option>
		<option type="text" name="M">L</option>
		<option type="text" name="M">XL</option>
		<option type="text" name="M">XXL</option>
		</select>
	


		<!-- <input type="text" name="disponibilidad_producto" placeholder="Disponibilidad" class="form-control mb-2" value="{{$producto->disponibilidad_producto}}"/> -->
		<br><input type="radio" name="disponibilidad_producto" value = 'True' /> Disponible
        <input type="radio" name="disponibilidad_producto" value = 'False' /> No Disponible
		<input type="text" name="stock_producto" placeholder="Stock" class="form-control mb-2" value="{{$producto->stock_producto}}"/>
		<textarea name="descripcion_producto" rows="4" cols="10" placeholder="Ingrese descripcion del producto" class="form-control"></textarea>
		<!-- <input type="file" name="ruta" id="" placeholder="Imagen" class="form-control mb-2"/> -->

		<button class="btn btn-warning btn-block" type="submit">Editar</button>
	</form>
  
@endsection