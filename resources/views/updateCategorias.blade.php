@extends('plantilla')

@section('seccion')

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="{{asset('js/updateCategorias.js') }}"> </script> 

    

	<h1>Editar Categoria </h1><h5>Id: {{$categoria->id_categoria}}</h5> <br>


		<div class="col-8"> 
			<form   id = "formulario_categoria" enctype ="multipart/form-data"  method="POST">
	
				{{-- {{method_field('PUT')}} --}}
				{{csrf_field()}}
	
				<input type="hidden" name ="id_categoriax"  id ="id_categoriax" value="{{$categoria->id_categoria}}">
	
	
				<input type="text" name="nombre_categoria" id="nombre_categoria"autocomplete="off"  enctype ="multipart/form-data"placeholder="Nombre" class="form-control mb-2" value="{{$categoria->nombre_categoria}}"/>
				<p class="text-danger mb-2 d-none" id="alert_nombre_categoria"></p>

				<button class="btn btn-warning btn-block" type="submit" id = "editar-submit">Editar</button>
				<div class="alert alert-succes my2 d-none" id ="alertSuccess"></div>
	
			</form>

		</div>
	
	
	







@endsection