@extends('plantilla')
<link rel="stylesheet" href="{{asset('css/carrito.css') }}">
@section('seccion')
<h1>Lista de productos Seleccionados:</h1>

<table class="table">
    <thead>
      <tr>
        <th scope="col">Producto:</th>
        <th scope="col">Nombre</th>
        <th scope="col">Talla</th>
        <th scope="col">Cantidad Seleccionada</th>
        <th scope="col">Precio</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      
        @foreach ($compraCliente as $item)
          <tr>
            <th scope="row"><img class="imagen" src="{{ asset('imagenes/'.$item->imagen) }}" width='100'></th>
            <td>{{$item->nombre_producto}}</td>
            <td>{{$item->talla_producto}}</td>
            <td>{{$item->cantidad_productos}}</td>
            <td>{{$item->precio_producto * $item->cantidad_productos}}</td>
            <td>
            <form action="{{URL('eliminarProductoEnCarrito',$item->id_compra)}}" method="POST" class="d-inline">
              {{method_field('DELETE')}}
              {{csrf_field()}}
              <button class="btn btn-danger btn-sm" type="submit">Eliminar Producto</button>
            </form>
          </td>
          </tr>
          <div id="elemento" style="visibility:hidden;">{{$valorTotal += ($item->precio_producto * $item->cantidad_productos)}}</div>
          
          @endforeach
    </tbody>
</table>
<label for="">Total: {{$valorTotal }}</label>
<div>
    <form action="{{URL('cerrarBoleta',$numeroVoleta)}}" method="POST" class="d-inline">
      {{csrf_field()}}
      <button class="btn btn-info btn-sm" type="submit">Pagar</button>
    </form>
</div>
<br><a  href="{{URL('productos')}}" type="button" class=" boton-carrito btn btn-dark">Ver mas productos</a>

@endsection