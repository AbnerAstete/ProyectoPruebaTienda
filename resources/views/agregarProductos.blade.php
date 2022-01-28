@extends('plantilla')

@section('seccion')


<br>
    <a href="{{URL('/')}}"><input type="button" value="Home"></a>
    <a href="{{URL('mostrarProducto')}}"><input type="button" value="Ver productos"></a>
<br>
<br>
    @if (session('mensaje'))
		<div class="alert alert-success">
			{{session('mensaje')}}
		</div>	
	@endif
    <div>
        <form method="POST" action="{{ URL('agregarProducto') }}"
        enctype ="multipart/form-data" 
        >
            {{csrf_field()}}
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
			@endforeach
            <br>
            <input type="text" name="nombre_producto" placeholder="Ingrese nombre del producto" class="form-control mb-2"/>

            <div class="form-group">
            <label for="talla_producto">Talla </label>
            <select class="form-control" name="talla_producto">
            <option>S</option>
            <option>M</option>
            <option>L</option>
            <option>XL</option>
            <option>XXL</option>
            </select></div>
            <input type="text" name="precio_producto" placeholder="Ingrese precio del producto" class="form-control mb-1"/>
            <input type="radio" name="disponibilidad_producto" value = 'True' /> Disponible
            <input type="radio" name="disponibilidad_producto" value = 'False' /> No Disponible
            <input type="text" name="stock_producto" placeholder="Ingrese stock del producto" class="form-control mb-2"/>
            <textarea name="descripcion_producto" rows="4" cols="10" placeholder="Ingrese descripcion del producto" class="form-control"></textarea>
            <input type="file" name="ruta" id="" placeholder="Ingrese una imagen del producto" class="form-control mb-2"/>
            
            <button class="btn btn-primary btn-block" type="submit">Agregar</button>
            <br>
          </form>
    </div>

@endsection
