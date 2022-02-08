@extends('plantilla')

@section('seccion')
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<br>
    <a href="{{URL('/')}}"><input type="button" value="Home"></a>
    <a href="{{URL('mostrarProducto')}}"><input type="button" value="Ver productos"></a>
<br>
<br>
    {{-- @if (session('mensaje'))
		<div class="alert alert-success">
			{{session('mensaje')}}
		</div>	
	@endif --}}
 <script type="text/javascript" src="{{asset('js/ingresarproducto.js') }}"> </script> 

    <div>

        <form  id = "formulario_producto"  method="POST" enctype ="multipart/form-data"  >
            {{csrf_field()}}
            {{-- @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
			@endforeach --}}
            <br>

            <input type="text" name="nombre_producto" id="nombre_producto" placeholder="Ingrese nombre del producto" class="form-control mb-2" autocomplete="off"/>
            <p class="text-danger mb-2 d-none" id="alert_nombre_producto"></p>
            <div class="form-group">
            <label for="talla_producto">Talla </label>
            <select class="form-control"  id ="talla_producto" name="talla_producto" autocomplete="off">
            <option>S</option>
            <option>M</option>
            <option>L</option>
            <option>XL</option>
            <option>XXL</option>
            </select></div>

            
            <input type="text" name="precio_producto" id ="precio_producto" placeholder="Ingrese precio del producto" autocomplete="off" class="form-control mb-1"/>
            <p class="text-danger mb-2 d-none" id="alert_precio_producto"></p>

            <input type="radio" name="disponibilidad_producto" id ="disponibilidad_producto" value = 'True' autocomplete="off"/> Disponible
            <input type="radio" name="disponibilidad_producto"id ="disponibilidad_producto"  value = 'False' autocomplete="off" /> No Disponible
            <input type="text" name="stock_producto" id ="stock_producto" placeholder="Ingrese stock del producto" class="form-control mb-2"autocomplete="off" />
            <p class="text-danger mb-2 d-none" id="alert_stock_producto"></p>

            <textarea name="descripcion_producto" id ="descripcion_producto" rows="4" cols="10" placeholder="Ingrese descripcion del producto" class="form-control" ></textarea>
            <input type="file" name="ruta" id="ruta"  placeholder="Ingrese una imagen del producto" class="form-control mb-2"/>
            <p class="text-danger mb-2 d-none" id="alert_descripcion_producto"></p>
            
           @foreach ($categorias as $item)
            @if($item->visible) 
                <input type="checkbox" id="categorias" name="categorias[]" value="{{$item->id_categoria}}">{{$item->nombre_categoria}}
            @endif
           @endforeach
         
            

            <button class="btn btn-primary btn-block" type="submit" id = "producto-submit">Agregar</button>
            <div class="alert alert-succes my2 d-none" id ="alertSuccess"></div>

            <br>
          </form>

    </div>

@endsection
