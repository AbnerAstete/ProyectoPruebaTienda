@extends('plantilla')

@section('seccion')

<br><h1>Lista Productos:</h1><br>
<table class="table">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nombre</th>
        <th scope="col">Talla</th>
        <th scope="col">Precio</th>
        <th scope="col">Disponibilidad</th>
        <th scope="col">Stock</th>
        <th scope="col">Descripcion</th>
        <th scope="col">Editar</th>
        <th scope="col">Eliminar</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($productos as $item)
      <tr>
        <th scope="row">{{ $item->id_producto }}</th>
        <td>{{ $item->nombre_producto }}</td>
        <td>{{ $item->talla_producto }}</td>
        <td>{{ $item->precio_producto }}</td>
        <td>{{ $item->disponibilidad_producto }}</td>
        <td>{{ $item->stock_producto }}</td>
        <td>{{ $item->descripcion }}</td>
        <td> <a href="{{URL('editarProducto',$item->id_producto)}}" class="btn btn-warning btn-sm">Editar</a></td>
        <td>
        <form action="{{URL('eliminarProducto',$item->id_producto)}}" method="POST" class="d-inline">
          {{method_field('DELETE')}}
          {{csrf_field()}}
          <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
        </form>
      </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection