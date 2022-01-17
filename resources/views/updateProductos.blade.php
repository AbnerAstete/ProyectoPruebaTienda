@extends('plantilla')

@section('seccion')
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
		<input type="text" name="talla_producto"  placeholder="Talla" class="form-control mb-2" value="{{$producto->talla_producto}}"/>
		<input type="text" name="disponibilidad_producto" placeholder="Disponibilidad" class="form-control mb-2" value="{{$producto->disponibilidad_producto}}"/>
		<input type="text" name="stock_producto" placeholder="Stock" class="form-control mb-2" value="{{$producto->stock_producto}}"/>
		<input type="text" name="descripcion_producto" placeholder="Descripcion" class="form-control mb-2" value="{{$producto->descripcion}}"/>
		<button class="btn btn-warning btn-block" type="submit">Editar</button>
	</form>
  
@endsection