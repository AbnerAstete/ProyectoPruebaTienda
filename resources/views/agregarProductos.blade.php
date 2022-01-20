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
                Talla 
            <select name="talla_producto" >

            <option type="text" name="M">XS</option>
            <option type="text" name="M">S</option>
            <option type="text" name="M">M</option>
            <option type="text" name="M">L</option>
            <option type="text" name="M">XL</option>
            <option type="text" name="M">XXL</option>


            </select>
            
            <br> <input type="text" name="precio_producto" placeholder="Ingrese precio del producto" class="form-control mb-1"/>
            <input type="radio" name="disponibilidad_producto" value = 'True' /> Disponible
            <input type="radio" name="disponibilidad_producto" value = 'False' /> No Disponible
            <input type="text" name="stock_producto" placeholder="Ingrese stock del producto" class="form-control mb-2"/>
            <textarea name="descripcion_producto" rows="4" cols="10" placeholder="Ingrese descripcion del producto" class="form-control"></textarea>
            <input type="file" name="ruta" id="" placeholder="Ingrese una imagen del producto" class="form-control mb-2"/>
            
            <button class="btn btn-primary btn-block" type="submit">Agregar</button>
          </form>
    </div>

@endsection
