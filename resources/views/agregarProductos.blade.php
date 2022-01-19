@extends('plantilla')

@section('seccion')

<br>
    <a href="{{URL('/')}}"><input type="button" value="Home"></a>
    <a href="{{URL('mostrarProducto')}}"><input type="button" value="Ver productos"></a>
    <div>
        <form method="POST" action="{{ URL('agregarProducto') }}"
        enctype ="multipart/form-data" 
        >
            {{csrf_field()}}
            <br>
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
			@endforeach
            <br>
            <input type="text" name="nombre_producto" placeholder="Ingrese nombre del producto" class="form-control mb-2"/>
            <input type="text" name="talla_producto" placeholder="Ingrese talla del producto" class="form-control mb-2"/>
            <input type="text" name="disponibilidad_producto" placeholder="Ingrese disponibilidad del producto" class="form-control mb-2"/>
            <input type="text" name="precio_producto" placeholder="Ingrese precio del producto" class="form-control mb-2"/>
            <input type="text" name="stock_producto" placeholder="Ingrese stock del producto" class="form-control mb-2"/>
            <input type="text" name="descripcion_producto" placeholder="Ingrese descripcion del producto" class="form-control mb-2"/>
            <input type="file" name="ruta" id="" placeholder="Ingrese una imagen del producto" class="form-control mb-2"/>
            
            <button class="btn btn-primary btn-block" type="submit">Agregar</button>
          </form>
    </div>

@endsection
