@extends('plantilla')

@section('seccion')
    <h1>Editar nota: {{$producto->id_producto}}</h1> 

    @if (session('mensaje'))
		<div class="alert alert-success">
			{{session('mensaje')}}
		</div>	
	@endif

    <form  action="{{ route('updateProducto') }}" method="POST">
        {{method_field('PUT')}}
		{{csrf_field()}}


		<input type="text" name="nombre" placeholder="Nombre" class="form-control mb-2" value="{{$producto->nombre_producto}}"/>
		<input type="text" name="precio" placeholder="Precio" class="form-control mb-2" value="{{$producto->precio_producto}}"/>
		<input type="text" name="talla"  placeholder="Talla" class="form-control mb-2" value="{{$producto->talla_producto}}"/>
		<input type="text" name="disponibilidad" placeholder="Disponibilidad" class="form-control mb-2" value="{{$producto->disponibilidad_producto}}"/>
		<input type="text" name="stock" placeholder="Stock" class="form-control mb-2" value="{{$producto->stock_producto}}"/>
		<input type="text" name="descripcion" placeholder="Descripcion" class="form-control mb-2" value="{{$producto->descripcion}}"/>
		<button class="btn btn-warning btn-block" type="submit">Editar</button>
	</form>
  
@endsection