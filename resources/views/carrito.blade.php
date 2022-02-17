@extends('plantilla')
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="{{asset('css/carrito.css') }}">
<script type="text/javascript" src="{{asset('js/carrito.js') }}"> </script>

@section('seccion')
<section class="showcase">
  
  <div id="table" class="col-md-12">
    <header >
    <legend><h1>Lista de productos Seleccionados:</h1> </legend>
    <div class="toggle"></div>
    </header>
    <br>
    <br>
    <br>
    <table class="table" style="color: aliceblue">
        <thead>
          <tr>
            <th scope="col">Producto:</th>
            <th scope="col">Nombre</th>
            <th scope="col">Talla</th>
            <th scope="col">Cantidad Seleccionada</th>
            <th scope="col">Precio</th>
            <th scope="col">Precio Total</th>
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
                <td>{{$item->precio_producto}}</td>
                <td>{{$item->precio_producto * $item->cantidad_productos}}</td>
                <td>  
                  <a  onclick="eliminar({{$item->id_compra}})" id="eliminar" type="button" class=" btn btn-danger btn-sm">Eliminar Producto</a>
                </td>
              </tr>
              <div id="elemento" style="visibility:hidden;">{{$valorTotal += ($item->precio_producto * $item->cantidad_productos)}}</div>
              
              @endforeach
        </tbody>
    </table>
    <br>
    <div id="total" style="text-align: right">
      <label for="">Total: {{$valorTotal }}</label>
        <form id='form-cerrar-boleta' method="POST" class="d-inline">
          <input name="numero_boleta" id='numero_boleta' type="hidden" value={{$numeroBoleta}}>
          {{csrf_field()}}
          <button class="btn btn-info btn-sm" id='submit-cerrar-boleta' type="submit">Pagar</button>
        </form>
    </div> 
  </div>
  
  
</section>



<div class="menu">
  <ul>
      <li><br><a  href="{{URL('productos')}}" type="button" class=" boton-carrito ">Ver mas productos</a></li>
  </ul>
</div>
<script>
  const menuToggle =document.querySelector('.toggle')
  const showcase =document.querySelector('.showcase')  
  menuToggle.addEventListener('click', () => {
    menuToggle.classList.toggle('active');
    showcase.classList.toggle('active');
  })
</script>


@endsection