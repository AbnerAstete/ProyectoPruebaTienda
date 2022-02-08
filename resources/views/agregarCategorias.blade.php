@extends('plantilla')

@section('seccion')


<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<br> <a href="{{URL('mostrarCategorias')}}"><input type="button" value="Ver categorias"></a>


<script type="text/javascript" src="{{asset('js/ingresarcategoria.js') }}"> </script> 

<div>

    <form id = "formulario_categoria"  method="POST"  enctype ="multipart/form-data">

        {{csrf_field()}}
        <input type="text" name="nombre_categoria" id="nombre_categoria" placeholder="Ingrese nombre de la categoria" class="form-control mb-2" autocomplete="off"/>
        <p class="text-danger mb-2 d-none" id="alert_nombre_categoria"></p>

        <button class="btn btn-primary btn-block" type="submit" id = "categoria-submit">Agregar</button>
        <div class="alert alert-succes my2 d-none" id ="alertSuccess"></div>





    </form>

<div>

@endsection
