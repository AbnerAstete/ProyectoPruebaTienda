@extends('plantilla')

@section('seccion')

<br><h1>Productos:</h1><br>
<table class="table">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nombre</th>
        <th scope="col">Talla</th>
        <th scope="col">Disponibilidad</th>
        <th scope="col">Stock</th>
        <th scope="col">Descripcion</th>
        <th scope="col">Handle</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($productos as $item)
      <tr>
        <th scope="row">{{ $item->id_producto }}</th>
        <td>{{ $item->nombre_producto }}</td>
        <td>{{ $item->talla_producto }}</td>
        <td>{{ $item->disponibilidad_producto }}</td>
        <td>{{ $item->stock_producto }}</td>
        <td>{{ $item->descripcion }}</td>
        <td>@mdo</td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection