@extends('plantilla')

@section('seccion')
<br><a href="{{URL('/')}}"><input type="button" value="Home"></a><br>
<br><h1>Lista Usuarios:</h1><br>

@if (session('mensaje'))
		<div class="alert alert-success">
			{{session('mensaje')}}
		</div>	
	@endif

<table class="table">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Rut</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Tipo Usuario</th>
        <th scope="col">Correo</th>
        <th scope="col">Eliminar</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($usuarios as $item)
      <tr>
        <th scope="row">{{ $item->id}}</th>
        <td>{{ $item->rut }}</td>
        <td>{{ $item->nombre }}</td>
        <td>{{ $item->apellido }}</td>
        <td>{{ $item->tipoUsuario->tipo_usuario }}</td>
        <td>{{ $item->correo }}</td>
        <td>
        <form action="{{URL('eliminarUsuarios',$item->id)}}" method="POST" class="d-inline">
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