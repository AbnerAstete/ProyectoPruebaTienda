@extends('plantilla')

@section('seccion')

    <br><a href="{{URL('/registrar')}}"><input type="button" value="Log In"></a><br>
    <br><a href="{{URL('mostrarUsuarios')}}"><input type="button" value="Ver Lista Usuarios"></a><br>
    <br><a href="{{URL('agregarProducto')}}"><input type="button" value="Agregar Productos"></a><br>
    <br><a href="{{URL('mostrarProducto')}}"><input type="button" value="Ver Lista Productos"></a><br>
    {{csrf_field()}}
    @if(Auth::check())
        <br><a href="{{URL('/ingresado/logout')}}"><input type="button" value="Salir"></a><br>
        
        <br>USUARIO: {{Auth::user()->rut}}<br>
    @endif

@endsection


