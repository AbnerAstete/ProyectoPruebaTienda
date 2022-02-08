@extends('plantilla')

@section('seccion')
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <br><a href="{{URL('/')}}"><input type="button" value="Home"></a><br> 
    <br> <a href="{{URL('mostrarCategorias')}}"><input type="button" value="Ver categorias"></a>
      

<br><h1 class = text-center>Lista Productos:</h1>
<link rel="stylesheet" href="{{asset('css/mostrarproductos.css') }}">
<script type="text/javascript" src="{{asset('js/mostrarProductos.js') }}"> </script> 

@if (session('mensaje'))
		<div class="alert alert-success">
			{{session('mensaje')}}
		</div>	
@endif
<body style="background-color: whitesmoke">
  
</body>

    <!-- Disponibles -->
<div  style="overflow-x:auto;" class="row">
 
      <div class="col-md-6">
        <h2 class = text-center style="color:rgb(29, 165, 11)" >Productos Disponibles</h2>
        <table class="table" border ="3px" bordercolor = "grey" >
          <thead>
            <tr  class="p-2 bg-success text-white">
              <th scope="col">Nombre</th>
              <th scope="col">Talla</th>
              <th scope="col">Precio</th>
              <th scope="col">Stock</th>
              <th scope="col">Descripcion</th>
              <th scope="col">Imagen</th>
              <th scope="col">Categorias</th>
              <th scope="col">Editar</th>
              {{-- <th scope="col">Eliminar</th> --}}
            </tr>

          </thead>
        
            <tbody >
              @foreach ($productosDisponibles as $item)
                    

                      <tr>
                        
                        <td>{{ $item->nombre_producto }}</td>
                        <td>{{ $item->talla_producto }}</td>
                        <td>{{ $item->precio_producto }}</td>
                        
                        @if($item->stock_producto<= 0) 
                          <td>{{ $item->stock_producto }}</td>
                        @else
                          {{-- as --}}
                          <td>{{ $item->stock_producto }}</td>
                        @endif 
                        <td>{{ $item->descripcion }}</td>
                        @if($item->imagen)
                        <td> <img src="{{ asset('imagenes/'.$item->imagen) }}"  width='100'> </td>
                        @else
                        <td> <img src="{{ asset('imagenes/default.jpg') }}"  width='100'> </td>
                        @endif
                        <td>
                                      @foreach ($item->categorias as $tag)
                                        @if ($tag->visible)
                                          <span class="badge badge-primary"># {{ $tag->nombre_categoria }}</span>
                                        @endif
                                      @endforeach 
                        </td>
                        <td><div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                            Opciones
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{URL('editarProducto',$item->id_producto)}} " >Editar</a>
                            <a class="dropdown-item"href="{{URL('deshabilitarProducto',$item->id_producto)}}">Deshabilitar</a>
                            <a class="dropdown-item" onclick="eliminarProducto({{$item->id_producto}})">Eliminar</a>
                          </div>
                        </div></td>
                        {{-- <td>
                          <form action="{{URL('eliminarProducto',$item->id_producto)}}" method="POST" enctype ="multipart/form-data" class="d-inline">
                            {{method_field('DELETE')}}
                            {{csrf_field()}}
                            <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                          </form>
                          </td> --}}
                        
                      </tr>
              @endforeach
            </tbody>
        </table>
       {{$productosDisponibles->links("pagination::bootstrap-4")}} 

      </div>

    <div class="col-md-6">
      <h2 class="text-center" style="color: red">Productos  No Disponibles</h2>


          <table class="table" border ="3px" bordercolor = "grey">
              <thead >
                <tr class="p-2 bg-danger text-white">
                  <th scope="col">Nombre</th>
                  <th scope="col">Talla</th>
                  <th scope="col">Precio</th>
                  <th scope="col">Stock</th>
                  <th scope="col">Descripcion</th>
                  <th scope="col">Imagen</th>
                  <th scope="col">Editar</th>
                </tr>

              </thead>
          
              <tbody>
                  @foreach ($productosnoDisponibles as $item)
                        <tr>
                          
                            <td>{{ $item->nombre_producto }}</td>
                            <td>{{ $item->talla_producto }}</td>
                            <td>{{ $item->precio_producto }}</td>
                            <td>{{ $item->stock_producto }}</td>
                            <td>{{ $item->descripcion }}</td>
                            @if($item->imagen)

                              <td> <img src="{{ asset('imagenes/'.$item->imagen) }}"  width='100'> </td>
                              @else
                              <td> <img src="{{ asset('imagenes/default.jpg') }}"  width='100'> </td>
                              @endif
                              <td><div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                  Opciones 
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                  <a class="dropdown-item" href="{{URL('editarProducto',$item->id_producto)}} " >Editar</a>
                                  <a class="dropdown-item"href="{{URL('habilitarProducto',$item->id_producto)}}">Habilitar</a>
                                  <a class="dropdown-item" onclick="eliminarProducto({{$item->id_producto}})">Eliminar</a>
                                </div>
                              </div></td>                            
                         
                        </tr>
                    
                  @endforeach
            </tbody>
          </table>
          {{$productosnoDisponibles->links("pagination::bootstrap-4")}}

      </div>
</div>



    <!-- HACER TABLA PRODUCTOS ELIMINADOS ACAAAAAAAAAAAAAAAAAAA -->

  <div >
    <h1 class="text-center" style="color: grey">Productos Eliminados</h1>

    <table class="table" border="3px" bordercolor = grey>
      <thead>
        <tr class="p-2 bg-dark text-white" >
          <th scope="col">Nombre</th>
          <th scope="col">Talla</th>
          <th scope="col">Precio</th>
          <th scope="col">Stock</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Imagen</th>
        </tr>

      </thead>

      <tbody>
        @foreach ($productosEliminados as $item)
              <tr>
                
                  <td>{{ $item->nombre_producto }}</td>
                  <td>{{ $item->talla_producto }}</td>
                  <td>{{ $item->precio_producto }}</td>
                  <td>{{ $item->stock_producto }}</td>
                  <td>{{ $item->descripcion }}</td>
                  @if($item->imagen)

                    <td> <img src="{{ asset('imagenes/'.$item->imagen) }}"  width='100'> </td>
                    @else
                    <td> <img src="{{ asset('imagenes/default.jpg') }}"  width='100'> </td>
                    @endif
                   
              </tr>
        @endforeach
      </tbody>
      
    </table>
    {{$productosEliminados->links("pagination::bootstrap-4")}}

  </div>

  
  {{-- Paginator::setPageName('page_a');
  $collection_A->links();
  
  Paginator::setPageName('page_b');
  $collection_B->links();  --}}




@endsection
