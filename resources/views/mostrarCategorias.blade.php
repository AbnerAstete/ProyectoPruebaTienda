@extends('plantilla')

@section('seccion')
<br><a href="{{URL('/')}}"><input type="button" value="Home"></a><br> 
<br> <a href="{{URL('/vistaCategorias')}}"><input type="button" value="Añadir categorias"></a>

<br><h1>Categorias:</h1>


        <div class="container">
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>

                        </tr>
                    </thead>


                    <tbody>
                        @foreach ($categorias as $item)
                            @if ($item->visible) 
                                <tr>
                                    <th scope="row">{{ $item->id_categoria }}</th>
                                    <td>{{ $item->nombre_categoria }}</td>
                                    <td> <a href="{{URL('editarCategoria',$item->id_categoria)}}" class="btn btn-warning btn-sm">Editar</a></td>
                                    <td>
                                        <form action="{{URL('eliminarCategoria',$item->id_categoria)}}" method="POST" enctype ="multipart/form-data" class="d-inline">
                                        {{method_field('PUT')}}
                                        {{csrf_field()}}
                                        <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                                        </form></td>
                               
                                <tr>
                             @endif

                        @endforeach
                    
                    </tbody>
                </table>
            </div>

        </div>
  
@endsection