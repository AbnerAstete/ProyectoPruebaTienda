@extends('plantilla')

@section('seccion')
	<br><a href="{{URL('mostrarProducto')}}"><input type="button" value="Ver Lista Productos"></a><br>
    <h1>Editar nota: {{$producto->id_producto}}</h1> 

    @if (session('mensaje'))
		<div class="alert alert-success">
			{{session('mensaje')}}
		</div>	
	@endif
	@foreach ($errors->all() as $error)
	<div class="alert alert-danger">{{$error}}</div>
	@endforeach

    <form  action="{{ URL('updateProductos',$producto->id_producto) }}" enctype ="multipart/form-data"  method="POST">
		{{method_field('PUT')}}
		{{csrf_field()}}


		<input type="text" name="nombre_producto" placeholder="Nombre" class="form-control mb-2" value="{{$producto->nombre_producto}}"/>
		<input type="text" name="precio_producto" placeholder="Precio" class="form-control mb-2" value="{{$producto->precio_producto}}"/>
		
		<div class="form-group">
            <label for="talla_producto">Talla </label>
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
		<input type="text" name="stock_producto" placeholder="Stock" class="form-control mb-2" value="{{$producto->stock_producto}}"/>
		<textarea name="descripcion_producto" rows="4" cols="10" placeholder="Ingrese descripcion del producto" class="form-control"></textarea>
		<input type="file" name="ruta" id="" placeholder="Imagen" class="form-control mb-2"/> 

		<button class="btn btn-warning btn-block" type="submit">Editar</button>
	</form>
  
@endsection